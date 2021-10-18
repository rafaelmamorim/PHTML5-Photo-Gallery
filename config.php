<?php

/*
  Config section for PHTML5 Photo Gallery
 * @version 1.0-042021
 * @author Rafael Amorim <github.com/rafaelmamorim>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

$config['default_language'] = 'pt';
$config['acceptLang'] = ['pt', 'en', 'es'];
$config['favicon'] = 'images/favicon.ico';

//Configurations used on facebook and twitter TAGs
$config['social_image'] = "images/phtml5gallery.jpg";
$config['social_image_type'] = "image/jpeg";
$config['social_image_width'] = "512";
$config['social_image_height'] = "512";

//Configurations used in facebook TAGs
$config['fb_app_ip'] = '';
$config['fbDefaultLang'] = 'pt_BR';
$config['fbAlternateLang'] = ['en_US'];

//Display images in order or not
$config['reverse_order'] = false;

//Display images in random order
$config['random_order'] = true;

//E-mail configs
$config['email_show_contact'] = true;
$config['email_address'] = "example@mail.com";
$config['email_subject'] = "[PHTML5 PHOTO GALLERY] MESSAGE";

//Social media address
$config['facebook'] = "#";
$config['twitter'] = "#";
$config['linkedin'] = "#";
$config['instagram'] = "#";
$config['github'] = "#";
$config['dribble'] = "#";
?>