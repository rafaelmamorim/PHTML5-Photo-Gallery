<?php

/*
 Contact form processing for PHTML5 Photo Gallery
 * @version 1.0-042021
 * @author Rafael Amorim <github.com/rafaelmamorim>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
*/

require_once("config.php");
require_once("label.php");

$lang = substr((isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : ''), 0, 2);
$acceptLang = $config['acceptLang'];
$lang = in_array($lang, $acceptLang) ? $lang : $config['default_language'];

$errors = [];
$data = [];

function died($error) {
    $errors['erro'] = $label[$lang]['died_line1'];
    $errors['erro'] .= $error . "<br /><br />";
    $errors['erro'] .= $label[$lang]['died_line2'];
}

function clean_string($string) {
    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
    return str_replace($bad, "", $string);
}

if (empty($_POST['email'])) {
    $errors['email'] = $label[$lang]['email_invalid'];
} 
if (empty($_POST['name'])) {
    $errors['name'] = $label[$lang]['name_invalid'];
} 
if (empty($_POST['message'])) {
    $errors['message'] = $label[$lang]['message_invalid'];
} else {

    $email_to = $config['email_address'];
    $email_subject = $config['email_subject'];

    // validation expected data exists
    if ((!isset($_POST['name']) || empty($_POST['name'])) ||
            (!isset($_POST['email']) || empty($_POST['email'])) ||
            (!isset($_POST['message']) || empty($_POST['message']))) {
        died($label[$lang]['error_form']);
    }


    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $errors['email'] = $label[$lang]['email_invalid'];
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $errors['name'] = $label[$lang]['name_invalid'];
    }

    if (strlen($message) < 2) {
        $errors['message'] = $label[$lang]['message_invalid'];
    }

    $email_message = $label[$config['default_language']]['form_text'];

    $email_message .= "Nome: " . clean_string($name) . "\n";
    $email_message .= "E-mail: " . clean_string($email) . "\n";
    $email_message .= "Mensagem: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
}
if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $sendEmail = mail($email_to, $email_subject, $email_message, $headers);
    if (!$sendEmail) {
        $data['success'] = false;
        $errors['error_send'] = $label[$lang]['error_send_email'];
        $data['errors'] = $errors;
    } else {
        $data['success'] = true;
        $data['message'] = $label[$lang]['success_send_email'];
    }
}
echo json_encode($data);
?>