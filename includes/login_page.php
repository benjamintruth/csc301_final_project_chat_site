<?php
/**
 * Created by PhpStorm.
 * User: sanningb2
 * Date: 7/27/2016
 * Time: 3:18 PM
 */




?>


<html>

<?php include $_SESSION['root']."/includes/header.php"; ?>


<body>


        <form action="/functional_pages/login.php" method="post">
    
            <div id="formConfig">
                <p id="message"></p>
                <h2>Username:</h2>
                <input type="text" name="username" pattern=".{5,15}" required title="5 to 10 characters" <?php if($_SERVER["REQUEST_METHOD"] == "POST"){echo "value=".$_POST["username"];}?>>
                
                <h2>Password:</h2>
                <input type="password" name="password" pattern=".{5,30}" required title="5 to 30 characters">
            </div>
            <div id="buttonConfig">
                <input type="submit" value="Submit">
            </div>
        </form>
   
</body>


<footer>



</footer>

</html>
    
        
        
        
