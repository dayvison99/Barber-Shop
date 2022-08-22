<?php
namespace Plataforma\Email;

require_once(__DIR__.'/EmailTable.php');

// Importa o PHP Mailer
require_once(__DIR__.'/../../../../public/base/PHPMailer/src/Exception.php');
require_once(__DIR__.'/../../../../public/base/PHPMailer/src/PHPMailer.php');
require_once(__DIR__.'/../../../../public/base/PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\Exception as MailException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

/**
 * Classe responsável por manipular e tratar o envio de emails na plataforma.
 */
class EmailController {

    /**
     * Objeto responsável por acessar o banco de dados.
     * @var EmailTable
     */
    private $comando;

    /**
     * @var PHPMailer
     */
    private $phpMailer;

    /**
     * @var string
     */
    private $emailSaida;

    public function __construct() {
        $this->comando = new EmailTable;

        // Busca as configurações do PHPMailer na base de dados
        $setup_email = $this->comando->getEmailSetup();

        $this->phpMailer = $this->inicializaPHPMailer($setup_email, $exceptions = null);
    }

    /**
     * Inicializa as configurações do PHPMailer para o envio de emails
     *
     * @param array $config Deve possuir os campos: `host`, `usuario`, `senha` e `porta`
     * @param bool $exceptions Indica se as exceções devem ser ativadas
     * @return PHPMailer
     */
    private function inicializaPHPMailer($config, $exceptions = null) {

        $phpMailer = new PHPMailer($exceptions); // Passar `true` ativa exceções

        //Server settings
        $phpMailer->SMTPDebug = 0;  // Ativa output de depuração detalhada
        $phpMailer->isSMTP();       // Configura mailer para usar SMTP
        $phpMailer->SMTPAuth = true;    // Ativa a autenticação do SMTP

        $phpMailer->SMTPOptions = array( // Configurações do SMTP
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $phpMailer->Host = $config['host']; // Especifica servidores SMTP principal e de backup
        $phpMailer->Username = $config['usuario']; // Usuário SMTP
        $phpMailer->Password = $config['senha']; // Senha SMTP
        $phpMailer->SMTPSecure = 'tls';  // Ativa criptografia TLS, `ssl` também aceito.
        $phpMailer->Port = $config['porta']; // Porta TCP para se conectar
        $phpMailer->IsHTML(true);
        $phpMailer->CharSet = 'utf-8';
        $phpMailer->Debugoutput = '';
        $phpMailer->isHTML(true); // Configura formato de email para HTML

        $this->emailSaida = $config['email_saida'];

        return $phpMailer;
    }

    /**
     * Função principal responsável pelo envio de emails
     * Obs: Depende da função `inicializaPHPMailer($config, $exceptions = null)`
     *
     * @param array $destinatarios Lista de destinatários do email, deve conter nome e email.
     * @param string $assunto  Assunto do email
     * @param string $conteudo Conteúdo do email a ser enviado
     * @param string $nomeLoja Nome da loja que envia o email
     * @return bool Indicador se o email foi enviado com sucesso
     */
    public function sendEmail($destinatarios, $assunto, $conteudo, $nomeLoja = "eCommerce-net") {

        // Emissor
        $this->phpMailer->setFrom($this->emailSaida, $nomeLoja);

        // Destinatários
        foreach($destinatarios as $destinatario) {
            if( isset($destinatario['isReply']) && $destinatario['isReply'] )
                $this->phpMailer->addReplyTo($destinatario['email'], $destinatario['nome']);
            else
                $this->phpMailer->addAddress($destinatario['email'], $destinatario['nome']); 
        }

        $this->phpMailer->Subject = $assunto;
        $this->phpMailer->Body = $conteudo;
        
        if(!$this->phpMailer->send()){ // Envia o email
            return false;
        }

		return true;
    }
}