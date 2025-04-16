<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use App\Models\General; // Asegúrate de importar tu modelo General

class EmailConfig
{
    static function config($name, $mensaje, $fromAddress = null, $fromName = null): PHPMailer
    {
        $mail = new PHPMailer(true);
        
        // Configuración SMTP (mejor usar config() en lugar de valores hardcodeados)
        $mail->isSMTP();
        $mail->Host = config('mail.mailers.smtp.host');
        $mail->SMTPAuth = true;
        $mail->Username = config('mail.mailers.smtp.username');
        $mail->Password = config('mail.mailers.smtp.password');
        $mail->SMTPSecure = config('mail.mailers.smtp.encryption');
        $mail->Port = config('mail.mailers.smtp.port');
        
        // Asunto y charset
        $mail->Subject = $name . ', ' . $mensaje;
        $mail->CharSet = 'UTF-8';
        
        // Configuración dinámica del remitente
        $fromEmail = $fromAddress ?? General::first()->email ?? config('mail.from.address');
        $fromName = $fromName ?? General::first()->name ?? config('mail.from.name');
        
        $mail->setFrom($fromEmail, $fromName);
        
        // Opcional: Configurar reply-to igual que from
        $mail->addReplyTo($fromEmail, $fromName);
        
        return $mail;
    }
}