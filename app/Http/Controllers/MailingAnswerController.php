<?php

namespace App\Http\Controllers;

use App\Helpers\EmailConfig;
use App\Models\MailingAnswer;
use App\Http\Requests\StoreMailingAnswerRequest;
use App\Http\Requests\UpdateMailingAnswerRequest;
use App\Models\Message;
use Error;
use Illuminate\Http\Request;
use Throwable;

class MailingAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function replyMailing(Request $request)
    {
        $message = Message::findOrFail($request->messageId);
        $name = $message->full_name ?? "Estimado usuario";
        $appUrl = env('APP_URL');


        try {
            $mail = EmailConfig::config($name, "Respuesta a tu mensaje");
            $mail->addAddress($message->email, $message->full_name);
            $mail->isHTML(true);

            // Versión texto plano
            $mail->AltBody = "Hola {$name},\n\nHas recibido una respuesta a tu mensaje:\n\n{$request->content}\n\nVisita nuestra web: {$appUrl}";

            // HTML mejorado
            $mail->Body = $this->buildReplyEmailHtml($name, $request->content, $appUrl, $request->subject);

            // Configuraciones adicionales
            $mail->Encoding = 'base64';
            $mail->SMTPKeepAlive = true;
            $mail->CharSet = 'UTF-8';

            if (!$mail->send()) {
                \Log::error('Error PHPMailer al responder mensaje: ' . $mail->ErrorInfo);
                throw new \Exception('Error al enviar la respuesta: ' . $mail->ErrorInfo);
            }

            MailingAnswer::create([
                'mailing_id' => $message->id,
                'subject' => $request->subject,
                'content' => $request->content
            ]);

            return redirect()->route('mensajes.show', $message->id)
                ->with('success', 'Respuesta enviada correctamente');
        } catch (\Exception $e) {
            \Log::error('Excepción en replyMailing: ' . $e->getMessage());
            return back()->with('error', 'Error al enviar la respuesta: ' . $e->getMessage());
        }
    }

    private function buildReplyEmailHtml($name, $content, $appUrl, $subject)
    {
        $logoUrl = $appUrl . '/mail/logo.png';
        $backgroundUrl = $appUrl . '/mail/fondo.png';
        $currentYear = date('Y');



        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta a tu mensaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body, html { 
            margin: 0; 
            padding: 0; 
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
        }
        .wrapper {
            padding: 20px;
        }
        .email-container { 
            max-width: 600px; 
            margin: 0 auto; 
            background-image: url('{$backgroundUrl}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
        }
        .overlay {
            background: linear-gradient(135deg, rgba(50, 54, 83, 0.75) 0%, rgba(50, 54, 83, 0.65) 100%);
            padding: 0 0 40px;
            backdrop-filter: blur(2px);
        }
        .header { 
            padding: 25px 0; 
            text-align: center;
            background-color: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            position: relative;
            overflow: hidden;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #18C991, #A9F1D1);
        }
        .logo {
            max-width: 200px;
            height: auto;
            filter: drop-shadow(0 3px 6px rgba(0,0,0,0.3));
            transition: transform 0.3s ease;
        }
        .logo:hover {
            transform: scale(1.05);
        }
        .content { 
            padding: 40px 30px; 
            text-align: center; 
            color: #FFFFFF;
            position: relative;
            z-index: 1;
        }
        .content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #18C991, #A9F1D1);
            border-radius: 3px;
        }
        .btn {
            display: inline-block;
            padding: 16px 32px;
            background: linear-gradient(135deg, #18C991 0%, #A9F1D1 100%);
            color: #323653 !important;
            text-decoration: none;
            border-radius: 32px;
            font-weight: 700;
            margin: 35px 0 15px;
            box-shadow: 0 6px 20px rgba(24, 201, 145, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 15px;
            position: relative;
            overflow: hidden;
        }
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transition: all 0.6s ease;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(24, 201, 145, 0.5);
        }
        .btn:hover::before {
            left: 100%;
        }
        .title {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 25px;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: relative;
            display: inline-block;
        }
        .highlight {
            color: #18C991;
            position: relative;
            display: inline-block;
            text-shadow: 0 2px 10px rgba(24, 201, 145, 0.4);
        }
        .highlight::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #18C991, #A9F1D1);
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(24, 201, 145, 0.5);
        }
        .message {
            background-color: rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            padding: 30px;
            margin: 25px 0;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
            text-align: left;
        }
        .message::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #18C991, #A9F1D1);
            border-radius: 4px 0 0 4px;
        }
        .message p {
            margin-bottom: 12px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .message p:last-child {
            margin-bottom: 0;
        }
        .response-content {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 3px solid #18C991;
        }
        .subject {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #18C991;
        }
        .footer {
            text-align: center;
            padding: 0 30px 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            position: relative;
        }
        .footer p {
            margin: 5px 0;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        .social-icons {
            margin: 25px 0 15px;
        }
        .social-icon {
            display: inline-block;
            margin: 0 10px;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            backdrop-filter: blur(5px);
        }
        .social-icon:hover {
            background-color: #18C991;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(24, 201, 145, 0.4);
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            margin: 20px 0;
        }
        @media only screen and (max-width: 480px) {
            .title {
                font-size: 28px;
            }
            .content {
                padding: 30px 20px;
            }
            .message {
                padding: 25px 20px;
            }
            .social-icon {
                margin: 0 8px;
                width: 36px;
                height: 36px;
                line-height: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="email-container">
            <div class="overlay">
            <div class="header">
                <a href="{$appUrl}" target="_blank">
                    <img src="{$logoUrl}" alt="QALLPA" class="logo">
                </a>
            </div>
            
            <div class="content">
                <h1 class="title">Respuesta a tu <span class="highlight">mensaje</span></h1>
                
                <div class="message">
                    <p style="font-size: 19px; margin-bottom: 15px; font-weight: 600;">Hola {$name},</p>
                    <p style="font-size: 16px; margin-bottom: 10px;">Aquí tienes la respuesta a tu mensaje:</p>
                    
                    <div class="response-content">
                        <div class="subject">{$subject}</div>
                        {$content}
                    </div>
                    
                    <p style="font-size: 16px; margin-top: 20px;">Si necesitas más información, no dudes en respondernos este correo.</p>
                </div>
                
                <a href="{$appUrl}" class="btn" target="_blank">Visita nuestra web</a>
                
              
                
                <div class="divider"></div>
            </div>
            
            <div class="footer">
                <p>© {$currentYear} QALLPA. Todos los derechos reservados.</p>
                <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
                <p style="font-size: 11px; margin-top: 15px; color: rgba(255,255,255,0.6);">Este es un correo automático, por favor no respondas directamente a este mensaje.</p>
            </div>
        </div>
        </div>
    </div>
</body>
</html>
HTML;
    }

    /**
     * Display the specified resource.
     */
    public function show(MailingAnswer $mailingAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailingAnswer $mailingAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMailingAnswerRequest $request, MailingAnswer $mailingAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailingAnswer $mailingAnswer)
    {
        //
    }
}
