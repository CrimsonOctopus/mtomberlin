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
            function generateReport(type){
                var start = $("#startDate").val();
                var end = $("#endDate").val();
                var selectedUsername = $("#selectedUsername").val();
                $('#results').empty();
                $.ajax({
                    type: "GET",
                    url: "generateReport.php",
                    dataType: "json",
                    data: {"type": type, "startDate": start, "endDate":end, "selectedUsername":selectedUsername},
                    success: function(data) {
                        switch(type){
                            case "count":
                                $('#results').append("<br>There were <u><b>"+data['COUNT(messageId)']+" messages</b></u> between "+start +" and "+end);
                                break;
                            case "joined":
                                $('#results').append("<br><u><b>"+selectedUsername+"</u></b> joined <u><b>"+data['MIN(timeOfPost)']+"</b></u>");
                                break;
                            case "last":
                                $('#results').append("<br><u><b>"+selectedUsername+"</u></b> last posted on <u><b>"+data['MAX(timeOfPost)']+"</b></u>");
                                break;
                        }
                    },
                    complete: function(data){
                    }
                });//ajax
            }
            
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
                <a href="admin.php">Admin Control</a>
                <a href="reports.php"  id="visited">Reports</a>
                <button id="adminLogout" onclick="logout()">Logout</button>
            </div>
        </nav>
        
        <div id="forumBody">
            <div id="filters">
                Start Date <input type="date" id="startDate">
                End Date <input type="date" id="endDate">
                <button id="generateCount" onclick="generateReport('count')">Message Count</button><br>
                Username <input type="text" id="selectedUsername">
                <button id="generateJoin" onclick="generateReport('joined')">Join Date</button>
                <button id="generateJoin" onclick="generateReport('last')">Last Post Date</button>
            </div>
            <div id="results"></div>
        </div>
        
    </body>
    
</html>