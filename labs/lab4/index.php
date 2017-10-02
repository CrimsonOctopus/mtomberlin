<?php
    if(isset($_GET['keyword']) && $_GET['keyword']!=""){
        $keyword = $_GET['keyword'];
        if($_GET['category']!=""){
            $keyword = $_GET['category'];
        }
        
        include 'api/pixabayAPI.php';
        if(isset($_GET['layout'])){
            $imageURLs = getImageURLs($keyword,$_GET['layout']);
        } else {
            $imageURLs = getImageURLs($keyword);
        }
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    } else {
        if($_GET['category']!=""){
            $keyword = $_GET['category'];
            include 'api/pixabayAPI.php';
            if(isset($_GET['layout'])){
                $imageURLs = getImageURLs($keyword,$_GET['layout']);
            } else {
                $imageURLs = getImageURLs($keyword);
            }
            $backgroundImage = $imageURLs[array_rand($imageURLs)];
        } else {
            include 'api/pixabayAPI.php';
            $BGs = getImageURLs('galaxy');
            $backgroundImage = $BGs[array_rand($BGs)];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            @import url("css/styles.css");
            body{
                background-image: url(<?= $backgroundImage ?>);
                background-size: 100% 100%;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body>
        <form>
            <input type="text" name="keyword" placeholder="Keyword" value=<?= (($_GET['keyword']!="")?$_GET['keyword']:"")?>>
            
            <!--Layout and Category sections will be added after completing the tutorial-->
            <div id="layoutDiv">
                <input type="radio" name="layout" value="horizontal" id="layout_h" <?= (($_GET['layout']=="horizontal")?"checked":"")?>/>
                <label for="layout_h"> Horizontal </label><br>
                 <input type="radio" name="layout" value="vertical" id="layout_v" <?= (($_GET['layout']=="vertical")?"checked":"")?> />
                 <label for="layout_v"> Vertical </label><br>
            </div>
            <br />
            <select name="category" style="color:black; font-size:1.5em">
                 <option value=""> - Select One - </option>
                 <option value="ocean"  <?= (($_GET['category']=="ocean")?"selected":"")?>> Sea </option>
                 <option value="mountain"  <?= (($_GET['category']=="mountain")?"selected":"")?>> Mountains </option>
                 <option value="forest"  <?= (($_GET['category']=="forest")?"selected":"")?>> Forest </option>
                 <option value="sky"  <?= (($_GET['category']=="sky")?"selected":"")?>> Sky </option>
            </select><br /><br />
            <input type="submit" value="Submit" />
        </form>
        <br><br>
        
        <?php
            if(!isset($imageURLs)){
                echo "<h2>Type a keyword to display a slideshow with random images from Pixabay</h2>";
            } else {
        ?>
        
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                    for($i = 0; $i < 7; $i++){
                        echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                        echo ($i == 0) ? "class='active'" : "";
                        echo "></li>";
                    }
                ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                    for($i=0;$i<7;$i++){
                        do {
                            $randIndex = rand(0, count($imageURLs));
                            
                        } while(!isset($imageURLs[$randIndex]));
                        
                        echo "<div class='item ";
                        echo ($i==0)?"active":"";
                        echo "'>";
                        echo "<img src='".$imageURLs[$randIndex]."'>";
                        echo "</div>";
                        unset($imageURLs[$randIndex]);
                    }
                ?>
            </div>
            
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        
        <?php
            }
        ?>
    </body>
</html>