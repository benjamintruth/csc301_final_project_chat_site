<?php
/**
 * Created by PhpStorm.
 * User: Xipetotec
 * Date: 4/23/2017
 * Time: 9:19 PM
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

//This page allows you to search to see if a specific username is taken. If so, a message will be displayed saying so.
if($_SERVER['REQUEST_METHOD'] == "POST"){

    // Get a list of books from the database with the isbn passed in the URL
    $sql = file_get_contents('sql/search.sql');
    $params = array(
        'username' => $_POST['username']
    );
    $statement = $conn->prepare($sql);
    $statement->execute($params);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);


}


?>


<html>

<?php include $_SESSION['root']."/includes/header.php"; ?>


<body>


<form action="/functional_pages/searchAccounts.php" method="post">

    <div id="formConfig">
        <p id="message"><?php if (sizeof($result) > 0){echo "Username taken";} ?></p>
        <h2>Enter here to search for username</h2>
        <input type="text" name="username" pattern=".{5,15}" required title="5 to 10 characters" <?php if($_SERVER["REQUEST_METHOD"] == "POST"){echo "value=".$_POST["username"];}?>>
    </div>



    <div id="buttonConfig">
        <input type="submit" value="Submit">
    </div>
</form>

</body>


<footer>



</footer>

</html>




