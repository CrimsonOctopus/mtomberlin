<?php
include 'inc/functions.php';
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
        <title>Herald: A Twitch IRC CoopRPG</title>
        <!--INTERNAL STYLE EXAMPLE
        <style>
            body {
                background-color:#000066 !important;
            }
        </style>-->
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
    </head>
<!-- closing head -->

    <!-- This is the body -->
    <!-- This is where we place the content of our website -->
    <body> <!--INLINE STYLE EXAMPLE style="background-color:black; color:white;"-->
        
        <nav>
            <div class="siteTitle">Herald</div>
            <hr>
            <div>
                <a href="../assignment1/index.html">Home</a>
                <a href="../assignment1/gameplay.html">Gameplay</a>
                <a href="../assignment1/mechanics.html">Mechanics</a>
                <a href="../assignment3/index.php" id="selected">Ships</a>
                <a href="../assignment1/contact.html">Contact</a>
            </div>
        </nav>
        
        <header>
            <h1>Ships, Stations and Planets</h1>
            <form>
                <input type="submit" value="Refresh"/>
                <input type="checkbox" name="ships" >Ships
                <input type="checkbox" name="stations">Stations
                <input type="checkbox" name="systems">Systems
                <input type="number" name="results" value="results">Results
            </form>
        </header>
        
        <br><br><br><br>
        <div id="ships">
            <h3 class="heading">Ships</h3>
            <?php
                if(isset($_GET['ships'])){
                    if(isset($_GET['results']) && $_GET['results']>0){
                        generateShips($_GET['results']);
                    } else {
                        generateShips(4);
                    }
                }
            ?>
        </div>
        
        <!--<div id="stations">
            <h3 class="heading">Stations</h3>
            <?php
                generateStations();
            ?>
        </div>
        
        <br><br><br><br>
        
        <div id="systems">
            <h3 class="heading">Systems</h3>
            <?php
                generateSystems();
            ?>
        </div>-->
        <div id="spacer"></div>
        
        <!-- This is the footer -->
        <!-- The footer goes inside the body but not always -->
        <footer>
            <img src="img/logo.png" alt="CSUMB Logo"/>
            CST336. 2017&copy; Tomberlin<br/>
            <strong>Disclaimer:</strong>The information in this wepage is fictitious. <br/>
            It is for academic uses only.
        </footer>
        <!-- closing footer -->
        
    </body>
    <!-- closing body -->

</html>