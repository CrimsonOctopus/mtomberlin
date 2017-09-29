<?php
    include 'inc/functions.php';
    
    initializeShips();
    initializeStations();
    initializeSystems();
    persistCheckbox("ships");
    persistCheckbox("stations");
    persistCheckbox("systems");
    persistNumberBox("results");
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
            <?php echo $_SESSION['shipsOn']!=1?'Select a category to browse game objects and locales.':'' ?>
            <form>
                <input type="submit" value="Browse"/>
                <input type="text" name="keyword" placeholder="Enter a keyword" value=<?php echo isset($_SESSION['keyword'])?$_SESSION['keyword']:''?>>
                <input type="checkbox" name="ships" value='on' <?php echo $_SESSION['shipsOn']==1?'checked':''?>>Ships
                <input type="checkbox" name="stations" value='on' <?php echo $_SESSION['stationsOn']==1?'checked':''?>>Stations
                <input type="checkbox" name="systems" value='on' <?php echo $_SESSION['systemsOn']==1?'checked':''?>>Systems
                <input type="number" name="results" value=<?php echo isset($_SESSION['results'])?$_SESSION['results']:4?>>
            </form>
        </header>
        
        <br><br><br><br>
            <?php
                if(isset($_GET['ships'])){
                    if(isset($_GET['results']) && $_GET['results']>0){
                        generateShips($_GET['results'], $_GET['keyword']);
                    } else {
                        generateShips(4, $_GET['keyword']);
                    }
                }
            ?>
        
            <?php
                if(isset($_GET['stations'])){
                    if(isset($_GET['results']) && $_GET['results']>0){
                        generateStations($_GET['results'], $_GET['keyword']);
                    } else {
                        generateStations(4, $_GET['keyword']);
                    }
                }
            ?>
        
            <?php
                if(isset($_GET['systems'])){
                    if(isset($_GET['results']) && $_GET['results']>0){
                        generateSystems($_GET['results'], $_GET['keyword']);
                    } else {
                        generateSystems(4, $_GET['keyword']);
                    }
                }
            ?>
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