<?php

//Back background color. Behind everything else.
$background_color_back = "#269288";
//Color for forms
$background_color_front = "#DAE3BC";
//Input form background color
$background_color_input = "#BCDAA5";
//Button color
$background_color_button = "#CAE0B0";

//Font color for large text
$font_color_large= "#79B598";
//Hyperlink font color
$font_color_link = "#41B993";
//Small font color
$font_color_small = "#208D88";


//Border
$border= "5px #4FBC89";

//Background image large
$background_image_large = "url('/resources/low-poly-bg.png')";
//Background image small
$background_image_small = "url('/resources/bg-tile-small.png')";

//session root readable variable
$root = $_SESSION['root'];


$css = "

    <style>
    
         
        body{

            background-image: $background_image_large;
            background-color: $background_color_back;
            font-family: 'Ubuntu', sans-serif;
            
         }
     
        h2{
     
        color:$font_color_large;
     
     
     }
     
        nav{
    
    
        background-color:$background_color_front;
        width:50%;
        height:5%;
        margin-left:20%;
        margin-right:10%;
        margin-top:2%;
        box-shadow:  3px 3px 30px 1px #41B993;
    }
    
        nav a{
        
        text-decoration:none;
        color: $font_color_link;
        padding-left:5%;
        margin-top: 20%;
    
    }
    
        form{
      
       background-color:$background_color_front;
      
       padding :5%;
       margin-left:30%;
       margin-top:5%;
       width:20%;
       box-shadow: 3px 3px 30px 1px #41B993;
    }
    
        form h2{
    
    width:50%;
    margin-top: 2%;
    margin-left: 5%;
    color: $font_color_large;
    
    }
    
        form select{
    
    width:50%;
    margin-top: 1%;
    margin-left: 5%;
    
    }
    
       
        #formConfig{
     
            
            font-family: 'Ubuntu', sans-serif;
            font-size:  20px;
            color: $font_color_small;
     
     }
     
        #formConfig select{
     
            background-color: $background_color_input;
            font-family: 'Ubuntu', sans-serif;
            font-size:  20px;
            color: $font_color_small;
     
     
     }
     
        #formConfig option{
     
            background-color: $background_color_input;
            font-family: 'Ubuntu', sans-serif;
            font-size:  20px;
            color: $font_color_small;
     
     
     }
     
        #formConfig input{
     
            background-color: $background_color_input;
            font-family: 'Ubuntu', sans-serif;
            font-size:  20px;
            color: $font_color_small;
     }       
     
        #formConfig p{
     
            font-family: 'Ubuntu', sans-serif;
            font-size:  20px;
            color: $font_color_small;
            
     }
       
       
       
        #chatWindow{
        
            width: 70%;
            height: 100%;
            
            margin-top:5%;
            margin-right:5%;
            margin-left:15%;
            border: $border;
            box-shadow: 3px 3px 30px 1px #41B993;
            background-color: $background_color_front;
   
        
        }
       
        #chatWindow #chatDisplay{
        
            width:  95%;
            height: 75%;

            padding-left: 3%;
            padding-top:  2%;
            overflow: auto;
            
            border: $border;
            
            word-wrap: break-word;
        
        }
        
        #chatWindow #buttons{
        
            width: 50%;
            height: 30%;
            margin-left: 30%;
            
        }
        
        #chatWindow p{
        
            font-family: 'Ubuntu', sans-serif;
            font-size: 20px;
            color: $font_color_small;
        }
        
        #chatWindow a{
        
            font-family: 'Ubuntu', sans-serif;
            font-size: 20px;
            color: $font_color_link;
        }
        
        #chatWindow #textBox{
        
            margin:auto;
            display: block;
            width: 90%;
            height 90%;
        
        }
        
        #chatWindow #buttonConfig{
        
            margin-left: 20%;
        
        }
        
        #buttonConfig input{
        
            font-family: 'Ubuntu', sans-serif;
            font-size:  30px;
            color: $font_color_large;
            background-color: $background_color_button;
            margin-left: 3%;
            margin-top: 3%;
           
        
        }
        
        .g-recaptcha{
        
            padding-top: 3%;
        }
       
        
        #mainElement{
        
            width: 50%;
            height: 80%;
            
            margin-top:5%;
            margin-right:5%;
            margin-left:20%;
            border: $border;
            box-shadow: 3px 3px 30px 1px #41B993;
            background-color: $background_color_front;
        
        }
        
        #mainElement #textContainerIndexPage{
        
            margin-left: 5%;
            margin-top: 5%;
            
            color: $font_color_small;
        }
        
        #mainElement h1{
        
            color: $font_color_large;
        }
        
        #mainElement a{
        
            color: $font_color_link;
        }
        
        #mainElement p{
        
            padding-top: 3%;
        }
    
    </style>
";

//Echo the style
echo $css;



