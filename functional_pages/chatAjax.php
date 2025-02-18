<?php
/**
 * Created by PhpStorm.
 * User: Xipetotec
 * Date: 8/4/2016
 * Time: 2:29 PM
 */
session_start();
include "config.php";

if(isset($_POST['action'])) {


    //Chat Database structure:
    /*
     * [0]  CHAT_ID                 (text)
     * [1]  START_TIMESTAMP         (int)
     * [2]  END_TIMESTAMP           (int)
     * [3]  USERS_CONNECTED         (boolean)
     * [4]  USER_ONE_USERNAME       (text)
     * [5]  USER_TWO_USERNAME       (text)
     * [6]  CHAT_CONTENTS           (text)
     *
     */

    //SESSION VARS

    /*
     * ['login']            boolean whether logged in
     * ['username']         string containing user's username
     * ['CHAT_ID']          chat ID in current database
     * ['root']             defined in Index, this is what's used to find files and their locations.
     * ['strangerNumber']   shows the position of a non-logged in user in the DB, whether they are user 1 or user 2.
     */



    switch ($_POST['action']) {

        //Create new chat table in DB
        case "Enter Chat":

            //If username is unset / does not exist, then generate a random username from a series of things that I will put together.
            if(!key_exists($_SESSION['username'])) {

                //Generate unique ID
                $unique = uniqid();

                //Set username to random string + stranger
                $_SESSION['username']="Stranger$unique";

            }

            //Check database for row where USER_TWO_USERNAME is unset. This represents an open chat.

            //Make string parsable version of session username
            $sessionUsername = $_SESSION['username'];

            //make SQL query. These are the parameters that search for open chats.
            //Username two has to be unset, representing a second user not being present.
            //User one username cannot be present user's username, because then you will reconnect with one of your old chats
            //Users connected has to be false, which shows that two people aren't currently connected. Not sure why this would happen.
            //End timestamp equals unset, this will be changed to the actual timestamp when a user leaves the chat. This shows that the chat is open.
            $sqlQuery = "SELECT * FROM chat WHERE 
                          USER_TWO_USERNAME='unset' AND 
                          USER_ONE_USERNAME!='$sessionUsername' AND 
                          USERS_CONNECTED = FALSE AND 
                          END_TIMESTAMP ='unset'
                          ";
            //Result
            $result = mysqli_query($conn, $sqlQuery);

            //Get number of rows
            $numRows = mysqli_num_rows($result);

            //These are open chats
            if ($numRows > 0) {

                //Turn result into array
                $rowArray = mysqli_fetch_assoc($result);

                //Get the chat ID of the first open chat.
                $CHAT_ID = $rowArray['CHAT_ID'];

                //Set CHAT_ID of that to be the Session CHAT_ID
                $_SESSION['CHAT_ID'] = $CHAT_ID;

                //Create variable for session username
                $session_username = $_SESSION['username'];


                //set USER_TWO_USERNAME in DB to be SESSION USERNAME
                //set USERS_CONNECTED to be true in DB
                //Set chat content to += "Connected to user, enter a message to chat!"
                $sqlQuery = "  UPDATE chat
                              SET USER_TWO_USERNAME='$session_username', USERS_CONNECTED = true,
                               CHAT_CONTENTS ='Connected to partner, enter a message to chat!<br><br> '
                              WHERE CHAT_ID='$CHAT_ID'";

                //If not logged in, set strangerNumber to 2
                if($_SESSION['login'] == false){

                    $_SESSION['strangerNumber'] = 2;

                }

                //make query
                mysqli_query($conn, $sqlQuery);

            } //If not there,
            //make new chat row
            else {

                // CHAT_ID is 10 random numbers and letters.
                $unique = uniqid();
                $id_short = substr($unique, 0, 10);
                $CHAT_ID = "$id_short";

                //  set SESSION CHAT_ID to be DB CHAT_ID
                $_SESSION['CHAT_ID'] = $CHAT_ID;

                //Create start timestamp
                $START_TIMESTAMP = date('m/d/Y h:i:s a', time());

                //Set USER_ONE_USERNAME = $_SESSION['username']
                $USER_ONE_USERNAME = $_SESSION['username'];


                //  Create chat row
                $sqlQuery = "
                
                INSERT INTO chat 
                (CHAT_ID, START_TIMESTAMP, END_TIMESTAMP, 
                USERS_CONNECTED, USER_ONE_USERNAME, USER_TWO_USERNAME, CHAT_CONTENTS
                 )
                VALUES('$CHAT_ID','$START_TIMESTAMP', 'unset', false,'$USER_ONE_USERNAME', 'unset', 
                'Waiting for partner...<br><br>')
                
                
                ";

                //If not logged in, set strangerNumber to 1
                if($_SESSION['login'] == false){

                    $_SESSION['strangerNumber'] = 1;

                }



                mysqli_query($conn, $sqlQuery);


            }

            
            break;
        //Updates Chat
        case "Update Chat":

            //Define session chat ID
            $sessionCHAT_ID = $_SESSION['CHAT_ID'];

            //Get current chat contents from DB
            $sqlQuery = "SELECT * FROM chat where CHAT_ID ='$sessionCHAT_ID'";
            $result = mysqli_query($conn, $sqlQuery);

            //Convert to array
            $return = mysqli_fetch_assoc($result);

            //Echo CHAT_CONTENTS
            echo $return['CHAT_CONTENTS'];


            break;
        //Send Message
        case "Send Message":


            //Define session chat ID
            $sessionCHAT_ID = $_SESSION['CHAT_ID'];

            //
            // //add POST ['message'} to DB CHAT_CONTENTS
            //

            //If logged in, will display your username. Otherwise, will display 'Stranger'.
            //Message from JS POST
            if($_SESSION['login'] == true){
                $message = $_SESSION['username'] . ": " . $_POST['message'] ."<br><br>";
            }
            else{
                $message = "Stranger ".$_SESSION['strangerNumber'] .": " . $_POST['message'] ."<br><br>";
            }


            //Gets the current row that needs to be edited
            $sqlQuery = "SELECT * FROM chat where CHAT_ID ='$sessionCHAT_ID'";

            //Result of the first query
            $result = mysqli_query($conn, $sqlQuery);

            //Returns the row
            $rowArray = mysqli_fetch_assoc($result);

            //String to replace old contents with
            $CHAT_CONTENT_UPDATE= $rowArray['CHAT_CONTENTS'] . $message ;

            //Replaces CHAT_CONTENTS with the updated version.
            $sqlQuery = "
            UPDATE chat 
            SET CHAT_CONTENTS='$CHAT_CONTENT_UPDATE' WHERE CHAT_ID='$sessionCHAT_ID'
            
            
            ";

            //Make the query
            mysqli_query($conn, $sqlQuery);


            break;
        //End Chat
        case "End Chat":

            //Sets session chat ID as a php variable that can be parsed inside the string
            $sessionCHAT_ID = $_SESSION['CHAT_ID'];

            //End Timestamp
            $END_TIMESTAMP = date('m/d/Y h:i:s a', time());

            //Set USERS_CONNECTED to false
            $sqlQuery = "
                          UPDATE chat 
                          SET USERS_CONNECTED= false, END_TIMESTAMP='$END_TIMESTAMP' WHERE CHAT_ID='$sessionCHAT_ID'";
            mysqli_query($conn, $sqlQuery);


            //Change chat ID to unset
            $_SESSION['CHAT_ID'] = "unset";




            break;
        
    }


}