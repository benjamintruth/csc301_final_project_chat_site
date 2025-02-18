<?php
/**
 * Created by PhpStorm.
 * User: Xipetotec
 * Date: 8/1/2016
 * Time: 4:56 PM
 */


//Load session info
session_start();
//Include login page
include $_SESSION['root']. "/includes/login_page.php";
//Get root from session
$root = $_SESSION['root'];

//End other information in SESSION
session_unset();
session_destroy();

//Restart session
session_start();
//Reset Session Root to what it was before session was destroyed.
$_SESSION['root'] = $root;


//Print logout message
echo"<script> document.getElementById('message').innerHTML = 'Logged out! :)'</script>";

