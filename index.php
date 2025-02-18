<?php
/**
 * Created by PhpStorm.
 * User: sanningb2
 * Date: 7/27/2016
 * Time: 12:03 PM
 */
session_start();

//For live site
$_SESSION['root'] = "/home/a2236036/public_html/";

//For local development
//$_SESSION['root'] = $_SERVER['DOCUMENT_ROOT'];



//SESSION VARS

/*
 * ['login']        boolean whether logged in
 * ['username']     string containing user's username. This is defined in login.php
 * ['CHAT_ID']      chat ID in current database, this is set by chatAjax
 * ['root']         defined in Index, this is what's used to find files and their locations.
 */

include $_SESSION['root'] ."/includes/index_main_page.php";




