<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $email_from = 'info@rahulsdigitalportfolio.com';

    $email_subject = 'New Form Submission';

    $email_body = "User Name: $name. \n" .
        "User Email: $visitor_email. \n" .
        "Subject: $subject. \n" .
        "User Message: $message. \n";

    $to = 'rahulsetiaboi@gmail.com';
    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";

    $secretKey = "6Lcpo0McAAAAAB5Ty4lEQkP_nMP827cFA2WiC88W";
    $responseKey = $_POST['g-recaptcha-response'];
    $UserIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

    $response = file_get_contents($url);
    $response = json_decode($response);
    
    if ($response->success){
        mail($to, $email_subject, $email_body, $headers);
        echo "Message Sent Successfully";
    } else {
        echo "Invalid Captcha, Please Try Again.";
    }
}
