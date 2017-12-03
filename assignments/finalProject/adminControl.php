<?php
session_start();

if(!isset($_SESSION['adminUsername'])){
    header("Location: adminLoginProcess.php");
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
                            $("#messages").append("<dl><dt><b>"+obj[i]['username']+"</b></dt><dd><p>"+obj[i]['timeOfPost']+"</p><br><p>"+obj[i]['text']+"</p><button id='editMessage' style='color:black' onclick='editMessage("+obj[i]['messageId']+")'>Edit</button><button id='deleteMessage' style='color:black' onclick='deleteMessage("+obj[i]['messageId']+")'>Delete</button></dd></dl>");
                        }
                }});
            }
            
            //Insert a message, then update the message list
            function sendMessage(){
                var username = $('#username').val();
                var text = $('#messageText').val();
                console.log("Username: "+username+", Text: "+text);
                
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
            
            function deleteMessage(id){
                $.ajax({
                    type: "GET",
                    url: "deleteMessage.php",
                    dataType: "json",
                    data: { "messageId": id },
                    complete: function(data,status) {
                       selectMessages();
                    }
                });//ajax
            }
            
            function editMessage(id){
                messageId = id;
                $('#messageModal').modal("show");
                $.ajax({
                    type: "GET",
                    url: "getMessage.php",
                    dataType: "json",
                    data: { "messageId": id },
                    success: function(data) {
                        console.log(data['username']);
                        console.log(data['text']);
                        $("#userName").html("<b>"+data['username']+"</b>")
                        $("#time").html("<p>"+data['timeOfPost']+"</p>");
                        $("#text").val(data['text']);
                    }
                });//ajax
            }
            
            function saveMessage(){
                var username = $('#userName').html();
                var text = $('#text').val();
                
                $.ajax({
                    type: "GET",
                    url: "updateMessage.php",
                    dataType: "json",
                    data: { "username": username, "text": text, "messageId" : messageId },
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
            var messageId = -1;
            $(document).ready(function(){
                $("#userFilter").change( function(){ filter(); } );
                $("#textFilter").change( function(){ filter(); } );
            });
            
            function logout(){
                $.ajax({
                    type: "GET",
                    url: "adminLogoutProcess.php",
                    dataType: "json",
                    data: { },
                    success: function(data) {
                        
                    },
                    complete: function(data){
                        location.href = "index.php"
                    }
                });//ajax
            }
        </script>
    </head>
    
    <body>
        <nav>
            <div class="siteTitle">Forum</div>
            <hr>
            <div>
                <a href="index.php">Home</a>
                <a href="admin.php"  id="visited">Admin Control</a>
                <a href="reports.php">Reports</a>
                <button id="adminLogout" onclick="logout()">Logout</button>
            </div>
        </nav>
        
        <div id="forumBody">
            <div id="filters">
                Filter By User <input type="text" id="userFilter"><br>
                Filter By Text <input type="text" id="textFilter"><br>
            </div>
            <div id="messages"></div>
            <div id="newMessage">
                Username <input type="text" id="username" value=<?= $_SESSION['adminUsername'] ?> disabled><br>
                Message <input type="text" id="messageText"><br>
                <button id="sendMessage" onclick="sendMessage()">Send</button>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="petNameModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <p id="userName"></p><br>
                   <p id="time"></p><br>
                   <div id="time"></div><br>
                   <textarea id="text" rows="3" cols="80"></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveMessage()">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </body>
    
</html>