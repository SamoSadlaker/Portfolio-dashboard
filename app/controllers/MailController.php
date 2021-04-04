<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "phpmailer" . DIRECTORY_SEPARATOR . "PHPMAiler.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "phpmailer" . DIRECTORY_SEPARATOR . "Exception.php";
require_once APP_ROOT . "controllers" . DIRECTORY_SEPARATOR . "phpmailer" . DIRECTORY_SEPARATOR . "SMTP.php";

class MailController
{
    public function sendRecoveryMail($email, $code)
    {
        require APP_ROOT . "settings.php";
        $mail = new PHPMailer(true);
        $year = Date("Y");
        try {
            $mail->isSMTP();
            $mail->Host = $sftp->host;
            $mail->SMTPAuth = true;
            $mail->Username = $sftp->username;
            $mail->Password = $sftp->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $sftp->port;

            $mail->setFrom($sftp->username, "System");
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->Subject = "Password recovery - Sadlaker dashboard";
            $mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head> <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> <meta http-equiv='X-UA-Compatible' content='IE=edge'/> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <meta http–equiv=“Content-Type” content=“text/html; charset=utf-8”> <meta http–equiv=“X-UA-Compatible” content=“IE=edge”> <meta name=“viewport” content=“width=device-width, initial-scale=1.0 “> <meta name=“format-detection” content=“telephone=no”> <link rel='preconnect' href='https://fonts.gstatic.com'> <link href='https://fonts.googleapis.com/css2?family=Source+Sans+Pro&family=Ubuntu:wght@500&display=swap' rel='stylesheet'> <style>body{padding: 0; margin: 0; background-color: #f6f9fc;}table{border-spacing: 0;}td{padding: 0;}.wrapper{width: 100%; table-layout: fixed; background-color: #f6f9fc; padding-bottom: 40px;}.webkit{max-width: 600px; background-color: #ffffff;}.table{margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: 'Source Sans Pro', sans-serif; color: #4a4a4a;}p, a{font-family: 'Source Sans Pro', sans-serif; font-weight: 400;}.ubuntu{font-family: 'Ubuntu', sans-serif;}</style></head><body> <center class='wrapper'> <div class='webkit'> <table class='table' align='center'> <tr> <td> <table width='100%' style='border-spacing:0;border-bottom:2px solid #747474;'> <tr> <td style='background-color:#E5E5E5;padding:15px;text-align:center;vertical-align:middle;'> <a href='https://samosadlaker.eu'><img height='60px' src='https://samosadlaker.eu/assets/img/logo.png' alt='Logo' title='Logo'></a> <p class='ubuntu' style='font-size:35px;text-decoration:none;font-weight:500;color:#0A87EA; margin:0;'> Sadlaker Dashboard</p></td></tr></table> </td></tr><tr> <td> <table width='100%' style='border-spacing: 0;'> <tr> <td style='padding:30px 50px;'> <p style='margin:0;font-size:20px;font-weight:500;'> Hello!</p><p style='margin-top: 5px;'>You received this email because we received a password reset request.</p></td></tr><tr> <td style='padding:30px 50px;text-align:center;'> <a href='https://dashboard.samosadlaker.eu/password&id={$code}' class='ubuntu' style='padding:10px 15px; background-color:#0A87EA; color:#f6f9fc;border-radius:5px;text-decoration:none;margin-top:10px;'>Reset my password</a> </td></tr><tr> <td style='padding:20px 50px;'> <p style='font-size:14px;'>If you have problems clicking the button. Copy this address and paste it into your browser. <a href='https://dashboard.samosadlaker.eu/password&id={$code}'>https://dashboard.samosadlaker.eu/password&id={$code}</a> </p></td></tr><tr> <td style='padding:20px 50px 10px 50px;'> <p>If you haven't forgotten your password, ignore this email and most importantly don't send anyone a recovery link.</p></td></tr></table> </td></tr><tr> <td> <table width='100%' style='border-spacing:0;background-color:#E5E5E5;padding:10px;border-top: 2px solid #747474;'> <tr> <td style='text-align:center;'> <p style='margin:0;'>Copyright &copy; {$year} <a href='https://samosadlaker.eu' style='color:#0A87EA;font-weight:500;'>samosadlaker.eu</a> | All rights reserved</p></td></tr></table> </td></tr></table> </div></center></body></html>";

            $mail->send();
        } catch (Exception $e) {
            die(json_encode([
          "status" => "error",
          "message" => $e->getMessage()
      ]));
        }
    }

    public function sendVerifyMail($email, $name, $code)
    {
        require APP_ROOT . "settings.php";
        $mail = new PHPMailer(true);
        $year = Date("Y");
        try {
            $mail->isSMTP();
            $mail->Host = $sftp->host;
            $mail->SMTPAuth = true;
            $mail->Username = $sftp->username;
            $mail->Password = $sftp->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $sftp->port;

            $mail->setFrom($sftp->username, "System");
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";
            $mail->Subject = "Verify account - Sadlaker dashboard";
            $mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head> <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> <meta http-equiv='X-UA-Compatible' content='IE=edge'/> <meta name='viewport' content='width=device-width, initial-scale=1.0'> <meta http–equiv=“Content-Type” content=“text/html; charset=utf-8”> <meta http–equiv=“X-UA-Compatible” content=“IE=edge”> <meta name=“viewport” content=“width=device-width, initial-scale=1.0 “> <meta name=“format-detection” content=“telephone=no”> <link rel='preconnect' href='https://fonts.gstatic.com'> <link href='https://fonts.googleapis.com/css2?family=Source+Sans+Pro&family=Ubuntu:wght@500&display=swap' rel='stylesheet'> <style>body{padding: 0; margin: 0; background-color: #f6f9fc;}table{border-spacing: 0;}td{padding: 0;}.wrapper{width: 100%; table-layout: fixed; background-color: #f6f9fc; padding-bottom: 40px;}.webkit{max-width: 600px; background-color: #ffffff;}.table{margin: 0 auto; width: 100%; max-width: 600px; border-spacing: 0; font-family: 'Source Sans Pro', sans-serif; color: #4a4a4a;}p, a{font-family: 'Source Sans Pro', sans-serif; font-weight: 400;}.ubuntu{font-family: 'Ubuntu', sans-serif;}</style></head><body> <center class='wrapper'> <div class='webkit'> <table class='table' align='center'> <tr> <td> <table width='100%' style='border-spacing:0;border-bottom:2px solid #747474;'> <tr> <td style='background-color:#E5E5E5;padding:15px;text-align:center;vertical-align:middle;'> <a href='https://samosadlaker.eu'><img height='60px' src='https://samosadlaker.eu/assets/img/logo.png' alt='Logo' title='Logo'></a> <p class='ubuntu' style='font-size:35px;text-decoration:none;font-weight:500;color:#0A87EA; margin:0;'> Sadlaker Dashboard</p></td></tr></table> </td></tr><tr> <td> <table width='100%' style='border-spacing: 0;'> <tr> <td style='padding:30px 50px;'> <p style='margin:0;font-size:20px;font-weight:500;'> Welcome {$name},</p><p style='margin-top: 5px;'>Click the verify email button to activate your account. Once you confirm your account, you will be able to use all functons.</p></td></tr><tr> <td style='padding:30px 50px;text-align:center;'> <a href='https://dashboard.samosadlaker.eu/verify&id={$code}' class='ubuntu' style='padding:10px 15px; background-color:#0A87EA; color:#f6f9fc;border-radius:5px;text-decoration:none;margin-top:10px;'>Verify email address</a> </td></tr><tr> <td style='padding:20px 50px;'> <p style='font-size:14px;'>If you have problems clicking the button. Copy this address and paste it into your browser. <a href='https://dashboard.samosadlaker.eu/verify&id={$code}'>https://dashboard.samosadlaker.eu/verify&id={$code}</a> </p></td></table> </td></tr><tr> <td> <table width='100%' style='border-spacing:0;background-color:#E5E5E5;padding:10px;border-top: 2px solid #747474;'> <tr> <td style='text-align:center;'> <p style='margin:0;'>Copyright &copy; {$year} <a href='https://samosadlaker.eu' style='color:#0A87EA;font-weight:500;'>samosadlaker.eu</a> | All rights reserved</p></td></tr></table> </td></tr></table> </div></center></body></html>";

            $mail->send();
        } catch (Exception $e) {
            die(json_encode([
          "status" => "error",
          "message" => $e->getMessage()
      ]));
        }
    }
}
