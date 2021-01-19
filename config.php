<?php
session_start();
require_once "GoogleAPI/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("1058706204544-uc8ag60mji5urvi50slih8se6nfkstaj.apps.googleusercontent.com");
$gClient->setClientSecret("gfEs_9mk_E67o5QUsLOeDv1u");
$gClient->setApplicationName("Login");
$gClient->setRedirectUri("http://localhost/GoogleLogin/g-callback.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
