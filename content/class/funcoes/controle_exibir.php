<?php

namespace Model;

class ControleExibir
{

    /**
     * Função responsável por definir quais os itens de Ui exibir
     * de acordo com o usuário logado. Retorna true caso seja exibido
     * tudo ou um array com os itens a exibir.
     *
     * @return void
     */
    public function defineElementosUi($itensUserCardapio)
    {
        if (!empty($_SESSION['PL_USER']) && !empty($_SESSION['PL_USER']['plano_id']) && $_SESSION['PL_USER']['plano_id'] == 1) { // Usuário com Plano Cardápio
            return $itensUserCardapio;
        } else { // Usuário Comum
            return true;
        }
    }

    /**
     * Função responsável por verificar se um item da UI deve ser exibido.
     *
     * @param string $slug Identificador do item.
     * @param boolean $exibirItem Devo verificar se slug está em $itensExibir.
     * @param array $itensExibir Lista de slugs permitidos.
     * @return void
     */
    public function devoExibirElementoUi($slug, $itensExibir)
    {
        if ($itensExibir === true || !empty($itensExibir[$slug]))
            return true;
        return false;
    }

    public function isPlanoCardapio()
    {
        if (!empty($_SESSION['PL_USER']) && !empty($_SESSION['PL_USER']['plano_id']) && $_SESSION['PL_USER']['plano_id'] == 1) { // Usuário com Plano Cardápio
            return true;
        } else { // Usuário Comum
            return false;
        }
    }
}
