<?php
namespace Plataforma\Email;

if( !class_exists('Banco') ) require_once(__DIR__.'/../../../config/dataBase.php');
use Banco;

/**
 * Classe responsável por acessar as tabelas do banco de dados referentes ao envio de emails na Plataforma.
 */
class EmailTable {

    /**
     * Variável responsável pela interface com o banco de dados.
     * @var Banco
     */
    private $bd;

    const SETUP_TABLE = 'setup_email';

    public function __construct() {
        $this->bd = new Banco();
    }

    /**
     * Returna um array de configurações para o PHPMailer
     *
     * @return array Array com os campos: `host`, `usuario`, `senha` e `porta` e `email_saida`
     */
    public function getEmailSetup() {
        $sqli = $this->bd->conexao();

        $query_email = "SELECT host, usuario, senha, porta, email_saida FROM ". self::SETUP_TABLE;
        $setup_email = $sqli->query($query_email);

        if($setup_email && $setup_email->num_rows > 0) {
            return $setup_email->fetch_array();
        } else {
            return [
                'host' => 'in-v3.mailjet.com',
                'usuario' => '2aea39a418f3ee8cb1307142a5ecba07',
                'senha' => 'e27f9114c7d3d8811ca3acb3660c9f09',
                'porta' => 587,
                'email_saida' => 'paulo@ecommercenet.com.br'
            ];
        }
    }
}