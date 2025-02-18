/**
 * Created by Xipetotec on 8/4/2016.
 */

/*

    Structure of chat program.

    CreateChat starts chat, either connecting to an open chat, or creating a new one.

    Updates the chat status every 1 seconds, checking to see if connected and updating the message.

    When sending message, update chat.

 */

//VARS
var connected = true;
//To prevent spam. Only lets users send 3 messages every 5 second period.
var messagesSentPer5Seconds = 0;


//On load
$(document).ready(function() {

    //Send message
    $('#submitButton').click( function() {
        
        sendMessage($('#textBox').val());
        $('#textBox').val("");
    });

    //Send on enter
    $("#textBox").keyup(function(event){
        if(event.keyCode == 13){
            $("#submitButton").click();
        }
    });

    //Disconnect button
    $('#disconnectButton').click( function() {
        
        //End the chat, preserves log as is.
        endChat();


    });

    //New Chat button
    $('#newChatButton').click( function() {
        
        //End old chat, the enter a new one. 
        endChat();
        enterChat();


    });

    //Update chat every 5 seconds, also update number of messages sent.
    window.setInterval(function(){
        messagesSentPer5Seconds = 0;
        updateChat();
    }, 5000);

    //When user leaves, disconnect
    window.onbeforeunload = function(){

        endChat();

    }


    //Enter Chat
    enterChat();


});



//Update chat display
function updateChat(){

    if(connected){

        //Calls to chatAjax for 'Update Chat'


        var ajaxurl = '/functional_pages/chatAjax.php',
        //Data vars, these are passed to the php file as POST
            data = {'action':'Update Chat'};

        $.post(ajaxurl, data, function (response) {

            //display the message
            document.getElementById("chatDisplay").innerHTML = response;


        });
    }


}

//Send message
function sendMessage(message){

        //update counter for messages sent
        messagesSentPer5Seconds++;

        if(messagesSentPer5Seconds < 3) {
            
            //Ajax call 'Send message'

            var ajaxurl = '/functional_pages/chatAjax.php',
            //Data vars, these are passed to the php file as POST
                data = {'action': 'Send Message', 'message': message};

            $.post(ajaxurl, data, function (response) {

                updateChat();
            });
        }

        //Display spam message
        else{

            document.getElementById("chatDisplay").innerHTML += "<br> Too many Messages! <br> Please wait a short period before sending another message!<br><br>";


        }



}

//Create Chat
function enterChat(){

    //Makes call to ajax under 'Enter Chat'


    var ajaxurl = '/functional_pages/chatAjax.php',
    //Data vars, these are passed to the php file as POST
        data = {'action':'Enter Chat'};

    $.post(ajaxurl, data, function (response) {

        //On return, update chat text.
        updateChat();
    });

    //Set connected to true to start updates
    connected = true;

}

//End chat
function endChat(){

    //Send message that user disconnected
    sendMessage("Partner Disconnected.");

    //Ajax call to end chat first. 
    var ajaxurl = '/functional_pages/chatAjax.php',
    //Data vars, these are passed to the php file as POST
        data = {'action':'End Chat'};

    $.post(ajaxurl, data, function (response){

        document.getElementById("chatDisplay").innerHTML += "<br><br> You have disconnected!";
    });


   //Set connnected to false to stop updates
    connected = false




    
}
