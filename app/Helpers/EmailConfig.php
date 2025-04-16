<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;

class EmailConfig
{
    static function config($name, $mensaje): PHPMailer
    {
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'mail.qallpa.pe';
        $mail->SMTPAuth = true;
        $mail->Username = 'hola@qallpa.pe';
        $mail->Password = '}+a2sco8jhvf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->Subject = '' . $name . ', ' . $mensaje;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('hola@qallpa.pe', 'Qallpa');
        return $mail;
    }
}
