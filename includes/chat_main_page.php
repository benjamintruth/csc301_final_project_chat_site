<?php
/**
 * Created by PhpStorm.
 * User: Xipetotec
 * Date: 8/1/2016
 * Time: 4:35 PM
 */?>


<html>



<?php include $_SESSION['root']."/includes/header.php"; ?>
<script src="/scripts/jquery-3.1.0.min.js"></script>
<script src="/scripts/chat.js"></script>





<body>


    <div id="chatWindow">

        <div id="formConfig">
            <p id="chatDisplay">

            </p>
            <input type="text" id="textBox" maxlength="200" >
        </div>
        <div id="buttonConfig">

            <input type="button" id="submitButton" value="Send">
            <input type="button" id="disconnectButton" value="Quit">
            <input type="button" id="newChatButton" value="Start New Chat">
        </div>

    </div>



</body>


</html>
