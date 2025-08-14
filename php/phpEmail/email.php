<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once 'vendor/autoload.php';

    function enviar_email_senha($email, $nome, $url) {
        $mail = new PHPMailer(true);

        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nicole.charale@gmail.com';
        $mail->Password = 'rbkt piln dqjv lodd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('nicole.charale@gmail.com', 'Banco de Tintas');
        $mail->addAddress($email, $nome); 
        $mail->isHTML(true);

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

                    <h3><a href="'.$url.'" 
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
            $mail->smtpClose();
            return false;
        } else {
            $mail->smtpClose();
            return true;
        }
    }

    function enviar_email_tinta($email, $nome, $url) {
        $mail = new PHPMailer(true);

        // Configurar SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nicole.charale@gmail.com';
        $mail->Password = 'rbkt piln dqjv lodd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('nicole.charale@gmail.com', 'Banco de Tintas');
        $mail->addAddress($email, $nome); 
        $mail->isHTML(true);

        $mail->Subject = 'Banco de Tintas - Nova tinta disponível!'; //assunto
        $mail->Body = '
            <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
                <div style="background-color: #84469b; border-radius: 0px 0px 10px 10px; padding: 20px; text-align: center;">
                    <h1 style="color: white;">
                        Banco de Tintas
                    </h1>
                </div>

                <div style="padding: 20px; text-align: center;">
                    <img src="https://cdn-icons-png.flaticon.com/512/232/232928.png" alt="Tinta" style="max-width: 100px;">

                    <h2 style="color: #8eb041; margin-top: 20px;">Nova tinta disponível!</h2>
                    <p style="font-size: 16px;">A tinta que você queria voltou a estar disponível para doação.</p>
                    <p style="font-size: 16px;">Clique no botão abaixo para <strong style="color: #8eb041;">ver a nova tinta.</strong></p>

                    <h3><a href="'.$url.'" 
                    style="display: inline-block; padding: 10px 20px; background-color: #8eb041; color: white; text-decoration: none; border-radius: 5px; margin-top: 15px;">
                    Visualizar tinta
                    </a><h3>
                </div>

                <div style="background-color: #84469b; border-radius: 10px 10px 0px 0px; padding: 10px; text-align: center; color: white;">
                    <h2 style="margin: 0;">Obrigado!</h2>
                </div>
            </div>';

        // Tentar enviar o email
        if (!$mail->send()) {
            $mail->smtpClose();
            return false;
        } else {
            $mail->smtpClose();
            return true;
        }
    }
?>