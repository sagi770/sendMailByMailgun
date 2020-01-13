<?php 
define('MAILGUN_KEY', 'YOUR_MAILGUN_KEY'); 	
define('MAILGUN_DOMAIN', 'YOUR_MAILGUN_DOMAIN'); 

function sendMailByMailgun($ToEmail,$toName,$subject,$html,$tag,$replyToEmail,$fromName,$fromEmail){
    $array_data = array(
        'from'				=> $fromName.' <'.$fromEmail.'>',
        'to'				=> $toName.'<'.$ToEmail.'>',
        'subject'			=> $subject,
        'html'				=> $html,
        'o:tracking'		=> 'yes',
        'o:tracking-clicks'	=> 'yes',
        'o:tracking-opens'	=> 'yes',
        'o:tag'				=> $tag,
        'h:Reply-To'		=> $replyToEmail
    );

    $ch = curl_init('https://api.mailgun.net/v3/'.MAILGUN_DOMAIN.'/messages');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, 'api:'.MAILGUN_KEY);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array_data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response   = curl_exec($ch);
    $results    = json_decode($response, true);

    curl_close($ch);

    return $results;
}

$ToEmail        = 'ToEmail';
$toName         = 'toName';
$subject        = 'Your subject';
$html           = 'Your HTML';
$tag            = 'tag';
$replyToEmail   = 'replyToEmail';
$fromName       = 'fromName';
$fromEmail      = 'fromEmail@'.MAILGUN_DOMAIN;

sendMailByMailgun($ToEmail,$toName,$subject,$html,$tag,$replyToEmail,$fromName,$fromEmail);
