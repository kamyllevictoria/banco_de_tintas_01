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
$mail->Subject = 'Recuperacao de Senhha';
$mail->Body    = "<h1>Recupere sua senha! :)</h1>
                  <p>Agora vai hehehe.</p>
                  <p>A gente arrasou!!! VAI TIME * O *</p>";

// Tentar enviar o email
if (!$mail->send()) {
    echo 'Email não enviado. Um erro foi encontrado: ' . $mail->ErrorInfo;
} else {
    echo 'Mensagem foi enviada.';
}

$mail->smtpClose();
?>