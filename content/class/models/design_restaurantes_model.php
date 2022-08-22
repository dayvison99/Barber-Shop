<?php

namespace Model;

if (!class_exists('Banco'))
    require_once(__DIR__ . '/../../../config/dataBase.php');

use Banco;

class DesignRestaurantesModel
{
    // Variável responsável por conectar ao banco de dados.
    private $sqli;

    private $deliverySqli;

    public function __construct()
    {
        $constantes = $this->defineConstantes();
        $bd = new Banco($constantes);
        $this->sqli = $bd->conexao();

        $bd = new Banco();
        $this->deliverySqli = $bd->conexao();
    }

    private function buscaDadosArquivo()
    {
        $arquivo      = fopen(VCARDAPIO_CONFIG_FILE, 'r');
        $conteudo_arquivo = fgets($arquivo, 1024);

        // Fecha arquivo aberto
        fclose($arquivo);

        $dados_arquivo = explode('&', $conteudo_arquivo);
        $dados_bd = explode(';', $dados_arquivo[1]);

        return $dados_bd;
    }

    private function defineConstantes()
    {
        $constantes = [];
        try {
            $dados_bd = $this->buscaDadosArquivo();
        } catch (\Exception $e) {
            return $constantes;
        }

        $constantes['HOST_SERVER'] = $dados_bd[0];
        $constantes['USER_SERVER'] = $dados_bd[1];
        $constantes['PASS_SERVER'] = $dados_bd[2];
        $constantes['DB_SERVER'] = $dados_bd[3];
        return $constantes;
    }

    /**
     * Busca a lista de informações de restaurantes
     * usadas na exibição de conteúdo.
     *
     * @return object
     */
    public function getRestaurantesDesign($campos = [], $id = null)
    {
        // Verifica se foram especificados os atributos da tabela
        if (!empty($campos))
            $fields = implode(', ', $campos);
        else
            $fields = "id, url, dominio_completo, plano_id, nome_loja as nome, logo, informacoes, slug, usa_dominio, status, excluido";

        $query = "SELECT $fields FROM restaurantes WHERE excluido = 0";
        // Verifica se foi informado um id
        if ($id)
            $query = $query . " AND id = $id";

        $restaurantes = $this->sqli->query($query);

        if (!empty($restaurantes->num_rows)) {
            if ($id)
                return $restaurantes->fetch_all(MYSQLI_ASSOC)[0];
            return $restaurantes->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    /**
     * Busca a lista de informações de restaurantes
     * usadas na exibição de conteúdo.
     *
     * @return object
     */
    public function getRestaurantesDesignBySlug($campos = [], $slug = null)
    {
        // Verifica se foram especificados os atributos da tabela
        if (!empty($campos))
            $fields = implode(', ', $campos);
        else
            $fields = "id, url, dominio_completo, plano_id, nome_loja as nome, logo, informacoes, slug, usa_dominio, status, excluido";

        $query = "SELECT $fields FROM restaurantes WHERE excluido = 0";
        // Verifica se foi informado um id
        if ($slug)
            $query = $query . " AND slug = '$slug'";

        $restaurantes = $this->sqli->query($query);

        if (!empty($restaurantes->num_rows)) {
            if ($slug)
                return $restaurantes->fetch_all(MYSQLI_ASSOC)[0];
            return $restaurantes->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }
    
    /**
     * Busca a lista de restaurantes
     * que possuem contratos na aplicação.
     * Pode buscar um restaurante especificado pelo id
     * 
     * @param array $campos Lista de atributos a serem buscados na tabela.
     * @param array $id Id do restaurante.
     * @return object
     */
    public function getRestaurantes($campos = [], $id = null)
    {
        // Verifica se foram especificados os atributos da tabela
        if (!empty($campos))
            $fields = implode(', ', $campos);
        else
            $fields = "*";

        $query = "SELECT $fields FROM restaurantes WHERE excluido = 0";
        // Verifica se foi informado um id
        if ($id)
            $query = $query . " AND id = $id";

        $restaurantes = $this->sqli->query($query);

        if (!empty($restaurantes->num_rows)) {
            if ($id)
                return $restaurantes->fetch_all(MYSQLI_ASSOC)[0];
            return $restaurantes->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    /**
     * Função responsável por inserir um restaurante na
     * base de dados.
     * 
     * @param array $post Dados a serem inseridos.
     * @return object
     */
    public function insertRestauranteDesign($post)
    {
        $dados = $this->removeDadosInvalidos($post);
        // As chaves são os atributos
        $campos = array_keys($dados);
        // Os values são os valores dos atributos
        $valores = array_values($dados);
        $valores = $this->formataValoresDb($valores);

        // Transforma em uma string com entradas separadas por vírgura
        $campos = implode(', ', $campos);
        $valores = implode(', ', $valores);

        try {
            $query = "INSERT INTO restaurantes ($campos) VALUES ($valores)";
            $this->sqli->query($query);
        } catch (\Exception $e) {
            return null;
        }

        return $this->sqli->insert_id;
    }

    /**
     * Função responsável por inserir categorias de um restaurante.
     * 
     * @param int $id Identificador do restaurante.
     * @return array $categorias Lista de ids das categorias
     */
    public function insertRestauranteCategoria($id_restaurante, $categorias)
    {

        $campos = ['id_restaurante', 'id_categoria'];
        // Transforma em uma string com entradas separadas por vírgura
        $campos = implode(', ', $campos);

        $valores = [];
        foreach ($categorias as $categoria)
            array_push($valores, "$id_restaurante, $categoria");

        try {
            $this->limpaRestauranteCategorias($id_restaurante);
            $query = $this->insertMultipleRowsSQL('restaurantes_categorias', $campos, $valores);

            $this->sqli->query($query);
        } catch (\Exception $e) {
            return null;
        }

        return $this->sqli->insert_id;
    }

    /**
     * Função responsável por buscar as categorias de um restaurante.
     * 
     * @param int $id Identificador do restaurante.
     */
    public function getRestauranteCategorias($restaurante_id)
    {
        try {
            $query = "SELECT c.id as id, c.nome as nome FROM restaurantes_categorias as rc INNER JOIN categorias as c ON c.id = rc.id_categoria WHERE rc.id_restaurante = $restaurante_id";
            $categorias = $this->deliverySqli->query($query);
        } catch (\Exception $e) {
            return null;
        }

        if (!empty($categorias->num_rows)) {
            return $categorias->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    /**
     * Busca a lista de categorias de estabelecimentos.
     * Pode buscar uma categoria especificada pelo id
     * 
     * @param array $campos Lista de atributos a serem buscados na tabela.
     * @param array $id Id da categoria.
     * @return object
     */
    public function getCategorias($campos = [], $id = null)
    {
        // Verifica se foram especificados os atributos da tabela
        if (!empty($campos))
            $fields = implode(', ', $campos);
        else
            $fields = "*";

        $query = "SELECT $fields FROM categorias WHERE excluido = 0 AND status = 1 ORDER By ordem";
        // Verifica se foi informado um id
        if ($id)
            $query = $query . " AND id = $id";

        $categorias = $this->deliverySqli->query($query);

        if (!empty($categorias->num_rows)) {
            if ($id)
                return $categorias->fetch_all(MYSQLI_ASSOC)[0];
            return $categorias->fetch_all(MYSQLI_ASSOC);
        }
        return null;
    }

    /**
     * @return object
     */
    public function getProdutosByCategoria($id_categoria, $campos = [])
    {
        // Verifica se foram especificados os atributos da tabela
        if (!empty($campos))
            $fields = implode(', ', $campos);
        else
            $fields = "*";

        $query = "SELECT $fields FROM produtos_categorias as pc INNER JOIN produtos on pc.id_produto = produtos.id ";
        $query = $query . "WHERE status = 1 AND excluido = 0 AND id_categoria = $id_categoria";

        $produtos = $this->deliverySqli->query($query);
        if (!empty($produtos->num_rows)) {
            return $produtos->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    /**
     * @return object
     */
    public function getImagemByProduto($id_produto)
    {
        $query = "SELECT id, legenda, CONCAT(nome, CONCAT(id, extensao)) as nome, status, ordem  FROM produtos_imagens ";
        $query = $query . "WHERE status = 1 AND excluido = 0 AND id_produto = $id_produto ";
        $query = $query . "ORDER BY ordem ASC LIMIT 1 OFFSET 0";

        $fotos = $this->deliverySqli->query($query);

        if (!empty($fotos->num_rows)) {
            return $fotos->fetch_all(MYSQLI_ASSOC)[0];
        }
        return [];
    }

    private function limpaRestauranteCategorias($restaurante_id)
    {
        try {
            $query = "DELETE FROM restaurantes_categorias WHERE id_restaurante = $restaurante_id";
            $this->sqli->query($query);
        } catch (\Exception $e) {
            return null;
        }
    }


    private function insertMultipleRowsSQL($table, $fields, $rows)
    {
        $multipleValues = '(' . $rows[0] . ')';

        for ($i = 1; $i < count($rows); $i++) {
            $multipleValues = $multipleValues . ', (' . $rows[$i] . ')';
        }
        return "INSERT INTO $table ($fields) VALUES $multipleValues";
    }


    /**
     * Função responsável por atualizar um restaurante na
     * base de dados.
     * 
     * @param array $post Dados a serem atualizados.
     * @param array $post Id da entidade a ser atualizada.
     * @return object
     */
    public function updateRestauranteDesign($post, $id)
    {
        $dados = $this->removeDadosInvalidos($post);
        // As chaves são os atributos
        $campos = array_keys($dados);
        // Os values são os valores dos atributos
        $valor = array_values($dados);
        $valores = $this->formataValoresDb($valor);

        $campoValor = $this->formataUpdate($campos, $valores);
        try {
            $query = "UPDATE restaurantes SET $campoValor WHERE id = $id";
            $this->sqli->query($query);
        } catch (\Exception $e) {
            return null;
        }
        return $id;
    }

    private function formataUpdate($campos, $valores)
    {
        $campoValor = $campos[0] . " = " . $valores[0];
        for ($i = 1; $i < count($campos); $i++)
            $campoValor = $campoValor . ", " . $campos[$i] . " = " . $valores[$i];
        return $campoValor;
    }

    /**
     * Dados a serem limpos antes de enviar ao banco de dados.
     * Permite apenas atributos que estejam definidos e cujos valores não sejam vazios.
     *
     * @param array $dados
     * @return array
     */
    private function removeDadosInvalidos($dados)
    {
        $newDados = [];
        if (!empty($dados["restaurante_id"]))
            $newDados["restaurante_id"] = $dados["restaurante_id"];
        if (!empty($dados["nome"]))
            $newDados["nome"] = $dados["nome"];
        if (!empty($dados["nome_loja"]))
            $newDados["nome_loja"] = $dados["nome_loja"];
        if (!empty($dados["logo"]))
            $newDados["logo"] = $dados["logo"];
        if (!empty($dados["slug"]))
            $newDados["slug"] = $dados["slug"];
        if (!empty($dados["informacoes"]))
            $newDados["informacoes"] = $dados["informacoes"];
        if (!empty($dados["url"]))
            $newDados["url"] = $dados["url"];
        if (isset($dados["usa_dominio"]))
            $newDados["usa_dominio"] = $dados["usa_dominio"];
        return $newDados;
    }

    private function formataValoresDb($valores)
    {
        foreach ($valores as $index => $valor) {
            if (is_numeric($valor))
                $valores[$index] = ($valor == (int) $valor) ? (int) $valor : (float) $valor;
            else {
                $valores[$index] = "'" . str_replace("'", "\'", $valor) . "'";
            }
        }
        return $valores;
    }
}
