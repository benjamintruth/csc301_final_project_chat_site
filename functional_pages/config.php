<?php
/**
 * Created by PhpStorm.
 * User: Xipetotec
 * Date: 7/28/2016
 * Time: 1:55 PM
 */



//For live site
$DB_USERNAME="a2236036_admin";
$DB_DATABASE="a2236036_db";
$DB_SERVER ="mysql11.000webhost.com";
$DB_PASSWORD="Steamp0wer";

//For local development

//$DB_USERNAME="root";
//DB_DATABASE="chat_database";
//$DB_SERVER ="127.0.0.1";
//$DB_PASSWORD="";




$conn =  mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

