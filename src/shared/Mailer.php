<?php

namespace Devvime\shared;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->isHTML(true);
        $this->mail->Host = EMAIL_HOST;
        $this->mail->Port = EMAIL_PORT;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = EMAIL_USER;
        $this->mail->Password = EMAIL_PASSWORD;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->CharSet = 'UTF-8';
    }

    public function send(array $data): bool
    {
        try {
            $fromName = $data['title'] ?? $data['subject'] ?? 'Mailer';

            $this->mail->setFrom(EMAIL_USER, $fromName);
            $this->mail->Subject = $data['subject'] ?? '';
            $this->mail->AltBody = $data['altbody'] ?? strip_tags($data['msgHTML'] ?? '');

            foreach ($data['recipients'] ?? [] as $recipient) {
                $this->mail->addAddress($recipient['email'], $recipient['name'] ?? '');
            }

            $this->mail->msgHTML($data['msgHTML'] ?? '');

            return $this->mail->send();
        } catch (Exception $e) {
            error_log('Mailer error: ' . $this->mail->ErrorInfo);
            return false;
        }
    }
}
