<?php

require 'class.phpmailer.php';

if (isset($_POST['contact_frm'])) {



    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $msg = '';

    $errorMsg = '';
    // Default response 
    $response = array(
        'status' => 'err',
        'msg' => 'Something went wrong, please try after some time.'
    );

    // Input fields validation 
    if (empty($_POST['first_name'])) {
        $pre = !empty($msg) ? '<br/>' : '';
        $errorMsg .= $pre . 'Please enter a valid first name.';
    }

    if (empty($_POST['last_name'])) {
        $pre = !empty($msg) ? '<br/>' : '';
        $errorMsg .= $pre . 'Please enter a valid email.';
    }

    if (empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $pre = !empty($msg) ? '<br/>' : '';
        $errorMsg .= $pre . 'Please enter a valid email.';
    }

    if (empty($_POST['phone'])) {
        $pre = !empty($msg) ? '<br/>' : '';
        $errorMsg .= $pre . 'Please enter a valid email.';
    }

    if (empty($_POST['message'])) {
        $pre = !empty($msg) ? '<br/>' : '';
        $errorMsg .= $pre . 'Please enter a valid email.';
    }


    // If validation successful 
    if (empty($errorMsg)) {


        $mail = new PHPMailer();
        // Settings
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host       = "smtp.gmail.com";    // SMTP server example
        $mail->SMTPDebug = false;                    // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "dexsolutions.web@gmail.com";                     //SMTP username
        $mail->Password   = "duqjvgehdgdkynpt";                               //SMTP password
        $mail->SMTPSecure = 'ssl';
        $mail->FromName = 'Contact Form';
        $mail->addAddress('dexsolutions.web@gmail.com');


        // Content
        $mail->isHTML(true);                       // Set email format to HTML
        $mail->Subject = 'BCC Studio';
        $mail->Body    = 'First Name: ' . $firstName . '<br>Last Name:' . $lastName . ' <br> Email: ' . $email . ' <br> Phone: ' . $phone . ' <br> Message: ' . $message . ' <br>';

        $mail->send();
        $response = array(
            'status' => 'ok',
            'msg' => 'Your email sent successfully.'
        );
    } else {
        $response['msg'] = $errorMsg;
    }

    // Return response 
    echo json_encode($response);
}
