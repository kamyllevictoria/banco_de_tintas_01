<?php
// Importar classes do PHPMailer no namespace global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

// Configurar SMTP
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'nicole.charale@gmail.com';
$mail->Password = 'rbkt piln dqjv lodd';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Informações do remetente
$mail->setFrom('nicole.charale@gmail.com', 'Banco de Tintas');

// Endereço de email e nome do destinatário
$mail->addAddress('kleberv512@gmail.com', 'Kleber Victor'); 
 
$mail->isHTML(true); // Definir formato do email para HTML

/*TO-DO (Nicole e Kleber): Template do corpo de e-mail para:
    - recuperar senha
    - tinta wishlist
*/


$mail->Subject = 'Banco de Tintas - Esqueceu sua senha?'; //assunto
$mail->Body = '
    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
        <div style="background-color: #84469b; border-radius: 0px 0px 10px 10px; padding: 20px; text-align: center;">
            <h1 style="color: white;">
                Banco de Tintas
            </h1>
        </div>

        <div style="padding: 20px; text-align: center;">
            <img src="https://cdn-icons-png.flaticon.com/512/181/181534.png" alt="Cadeado" style="max-width: 100px;">

            <h2 style="color: #8eb041; margin-top: 20px;">Esqueceu sua senha?</h2>
            <p style="font-size: 16px;">Não se preocupe! É hora de recuperar seu login.</p>
            <p style="font-size: 16px;">Clique no botão abaixo para <strong style="color: #8eb041;">criar uma nova senha.</strong></p>

            <h3><a href="https://seudominio.com/redefinir-senha?token=SEU_TOKEN" 
               style="display: inline-block; padding: 10px 20px; background-color: #8eb041; color: white; text-decoration: none; border-radius: 5px; margin-top: 15px;">
               Recriar senha
            </a><h3>
        </div>

        <div style="background-color: #84469b; border-radius: 10px 10px 0px 0px; padding: 10px; text-align: center; color: white;">
            <h2 style="margin: 0;">Obrigado!</h2>
        </div>
    </div>';

// Tentar enviar o email
if (!$mail->send()) {
    echo 'Email não enviado. Um erro foi encontrado: ' . $mail->ErrorInfo;
} else {
    echo 'Mensagem foi enviada.';
}

$mail->smtpClose();
?>