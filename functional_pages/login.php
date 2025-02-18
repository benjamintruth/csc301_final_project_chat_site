<?php
/**
 * Created by PhpStorm.
 * User: sanningb2
 * Date: 7/27/2016
 * Time: 12:28 PM
 */
session_start();
//Connect login page to database for validation later

    
    //DB config file
    include $_SESSION['root']. "/functional_pages/config.php";
    session_start();


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//If User has hit submit
if($_SERVER["REQUEST_METHOD"] == "POST") {

   //Define username and password entered
    $enteredUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $enteredPassword = mysqli_real_escape_string($conn, $_POST['password']);

    //Define query. Looks for a row with the specified username and password
    $sqlQuery = "SELECT * FROM accounts where username='$enteredUsername' and password='$enteredPassword'";

    //Returned result
    $result = mysqli_query($conn, $sqlQuery);

    //Get number of rows.
    $numberOfRows = mysqli_num_rows($result);

    //If the query is found, the number should only be one. On the off chance that there could be duplicates,
    //I have it set to check for greater than 1
    if($numberOfRows > 0){

        //Set login to true
        $_SESSION['login'] = true;
        
        //Adds username to session
        $_SESSION['username'] = $enteredUsername;

        
        //Redirect to chat page
        header("Location: /functional_pages/chatMain.php");
        mysqli_close($conn);

    }

    //On login fail
    else{

        //Close connection
        mysqli_close($conn);

        //include page
        include $_SESSION['root']. "/includes/login_page.php";


        //Send message
        echo "
            <script>document.getElementById('message').innerHTML ='Login Failed!<br>Incorrect Username or Password.';</script>
        ";
    }
    
}

//On first load of page
else{
   
    mysqli_close($conn);
    include $_SESSION['root']. "/includes/login_page.php";

}







    

