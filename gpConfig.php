<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '618201160029-jbm03758a8cl04f5i2kjfksdgdbctv84.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'Nb8V0emN0vQh6-iulRrYlhkz'; //Google client secret
$redirectURL = 'http://127.0.0.1/safal/index.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>