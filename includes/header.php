<?php
/**
 * Created by PhpStorm.
 * User: Xipetotec
 * Date: 8/1/2016
 * Time: 4:48 PM
 */

    //Defines server root to be used in includes.

?>
<head>
    <!-- Google font load -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <!-- include css -->
    <?php include $_SESSION['root']."/css/css_php.php"; ?>
    
    <nav>
        <a href="/index.php">Home</a>
        <a href="/functional_pages/create_account.php">Create An Account</a>
        <a href="/functional_pages/chatMain.php">Chat</a>
        <a href="/functional_pages/searchAccounts.php">Search for username</a>
        
        
        <?php
        //Script to determine whether to link to login or l68ogout
        if(array_key_exists('login', $_SESSION)) {
            if ($_SESSION['login'] == true) {

                echo "<a href=\"/functional_pages/logout.php\">Logout</a>";
               
            }
        }
        else {

            echo "<a href=\"/functional_pages/login.php\">Login</a>";

        }

        ?>


        

    </nav>

</head>



