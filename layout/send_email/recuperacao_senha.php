<?php 
require("../../config/start.php");
require("../../layout/send_email/header.php") ?>
<tr style="border-top: 1px solid #cdcdcd; margin-top: 30px; float: left; width: 100%;">
    <td>
        <h1 style="color: #353535; text-align: justify; font-size: 25px;">Olá, <?php echo $nome; ?>!</h1>
        <p style="color: #353535; text-align: justify;">
           Estamos te enviando um link para que você possa alterar sua senha!
        </p>
        <p style="color: #353535; text-align: justify;">
            Para alterar sua senha do SaveShare, <a href="<?php echo $link?>" target="_blank" style="color: #353535">clique aqui</a> ou cole o seguinte link no seu navegador:
            <br />
            <?php echo $link ?>
        </p>
        <p style="color: #353535; text-align: justify;">
            Se não foi você a realizar essa solicitação, ignore este email ou entre em contato com nosso suporte <a href="<?php echo site_url().'suporte';?>" target="_blank" style="color: #353535">clicando aqui</a>.
        </p>
        <p style="color: #353535; text-align: justify;">
            Esse link é válido por 24 horas a partir da solicitação de troca.
        </p>
        <br />
        <p style="color: #353535; text-align: justify;">
            Faça seu login clicando <a href="<?php echo site_url()?>" style="color: #353535" >aqui</a>, depois vá na aba de extrato e confira todo o seu saldo.
        </p>

        <p style="color: #353535; text-align: justify;">
            Sempre que existir uma nova oferta que seja do seu interesse estaremos lhe enviando por e-mail. Você também pode acessar nosso portal e acompanhar todas as ofertas que já temos para você.Não perca tempo, escolha as ofertas, compartilhe e ganhe! Obrigado pela parceria e confiança.
        </p>
    </td>
</tr>
<?php require("layout/send_email/footer.php") ?>