<?php

//start session on web page
// session_start();
//https://console.cloud.google.com/apis/credentials/oauthclient
//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('79376855653-91ci3lhr8jnhlrlivquqo2qa061r24lk.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('xkd8aC5-3X_QWpui0HfNIboM');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/project/add_1.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>