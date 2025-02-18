<?php
/**
 * Created by PhpStorm.
 * User: Xipetotec
 * Date: 8/1/2016
 * Time: 5:12 PM
 */
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    include "config.php";

    //Define vars from post for readability purposes, run real escape string on them to sanitize.
    $enteredUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $enteredPassword = mysqli_real_escape_string($conn, $_POST['password']);
    $enteredEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $enteredFirstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $enteredLastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $enteredSex = mysqli_real_escape_string($conn, $_POST['sex']);
    $enteredCountryCode = mysqli_real_escape_string($conn, $_POST['countryCode']);

    //Boolean to determine if page has been included already, because both of these If statements can be true.
    $pageIncluded = false;
    
    //Sql query to check if username or email already exist
    $checkIfAccountExistsQuery = "SELECT * from accounts where username='$enteredUsername' or email='$enteredEmail'";
    $result = mysqli_query($conn, $checkIfAccountExistsQuery);

    //Check to see if recaptcha was filled out correctly.
    //If the string length is longer than 0, then it will have been filled correctly. Otherwise, it will fail.
    //If failed, then send a fail with the message reported.
    if( strlen($_POST['g-recaptcha-response']) == 0){

        //Turn page included true
        $pageIncluded = true;
        //include HTML page.
        include $_SESSION['root']. "/includes/create_account_page.php";

        //Display error message
        echo"
        
        <script> 
        document.getElementById('errorDisplay').innerHTML += 'reCaptcha filled out incorrectly!<br>';
        </script>
        
        ";


    }

    //Conditional case if that email or account is already used. Will echo the page again,
    // along with a message displaying that those are already taken.
    else if( mysqli_num_rows($result) > 0){

        //If the previous case has not included the page yet
        if($pageIncluded == false){

            //include HTML page.
            include $_SESSION['root']. "/includes/create_account_page.php";

        }
        
        //Display error message
        echo"
        
        <script> 
        document.getElementById('errorDisplay').innerHTML += 'That username or email address is already taken.<br>';
        </script>
        
        ";
        

    }
    
    //Create row for this account
    else{

        //Add row to table
        $createAccountQuery = "
        INSERT INTO accounts (username, password, firstname, lastname, sex, country, email)
        VALUES( '$enteredUsername', '$enteredPassword', '$enteredFirstName', '$enteredLastName', '$enteredSex', '$enteredCountryCode', '$enteredEmail');
        
        ";
        $result = mysqli_query($conn, $createAccountQuery);
        

        //Include HTML page
        include $_SESSION['root']. "/includes/create_account_page.php";

        //Give success notice
        echo"
        
        <script> 
        
        document.getElementById('errorDisplay').innerHTML= 'Account created successfully!';
        </script>
        
        ";


    }


}
//If page s on load for the first time, just include the html.
else{

    //include HTML page.
    include $_SESSION['root']. "/includes/create_account_page.php";

}




