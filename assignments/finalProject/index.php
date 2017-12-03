<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: userLogin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en-US">
<!--
Mathew Tomberlin
CSUMB CST 336
9/4/2017
mechanics.html
-->

<!-- This is the head -->
<!-- All styles and javascript go inside the head -->
    <head>
        <meta charset="utf-8"/>
        <title>Forum</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <script>
            //Select messages from the database and append them
            function selectMessages(username,text){
                if(typeof(username)!="string"||username==undefined){
                    username="";
                }
                if(typeof(text)!="string"||text==undefined){
                    text="";
                }
                
                $.ajax({ 
                    url: "selectMessages.php",
                    data: {"username":username, "text":text},
                    success: function(data){
                        var obj = JSON.parse(data);
                        var count = obj.length;
                        $("#messages").empty();
                        for(var i = 0; i < count; i++){
                            $("#messages").append("<dl><dt><b>"+obj[i]['username']+"</b></dt><dd><p>"+obj[i]['timeOfPost']+"</p><br><p>"+obj[i]['text']+"</p></dd></dl>");
                        }
                }});
            }
            
            //Insert a message, then update the message list
            function sendMessage(){
                var username = $('#username').val();
                var text = $('#messageText').val();
                $('#messageText').val("");
                
                $.ajax({
                    type: "GET",
                    url: "insertMessage.php",
                    dataType: "json",
                    data: { "username": username, "text": text },
                    complete: function(data,status) {
                       selectMessages();
                    }
                });//ajax
            }
            
            function filter(){
                var username = $('#userFilter').val();
                var text = $('#textFilter').val();
                
                if((username.length==0||username.length>=3)&&(text.length==0||text.length>=3)){
                    selectMessages(username,text);
                }
            }
            
            function logout(){
                $.ajax({
                    type: "GET",
                    url: "userLogoutProcess.php",
                    dataType: "json",
                    data: { },
                    success: function(data) {
                        
                    },
                    complete: function(data){
                        location.href = "userLogin.php"
                    }
                });//ajax
            }
            
            $(document).ready(function(){
                selectMessages();
                $("#userFilter").change( function(){ filter(); } );
                $("#textFilter").change( function(){ filter(); } );
            });
        </script>
    </head>
    
    <body>
        <nav>
            <div class="siteTitle">Forum</div>
            <hr>
            <div>
                <a href="index.php" id="visited">Home</a>
                <a href="admin.php">Admin Control</a>
                <button id="logout" onclick="logout()">Logout</button>
            </div>
        </nav>
        
        <div id="forumBody">
            <div id="filters">
                Filter By User <input type="text" id="userFilter"><br>
                Filter By Text <input type="text" id="textFilter"><br>
            </div>
            <div class="messageBox" id="newMessage">
                Username <input type="text" id="username" value=<?= $_SESSION['username'] ?> disabled><br>
                Message <input type="text" id="messageText"><br>
                <button id="sendMessage" onclick="sendMessage()">Send</button>
            </div>
            <div id="messages"></div>
        </div>
    </body>
</html>