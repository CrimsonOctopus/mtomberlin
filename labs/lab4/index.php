<?php

$backgroundImage="img/sea.jpg";

if(isset($_GET['keyword'])){
    include 'api/pixabayAPI.php';
    
    $keyword = $_GET['keyword'];
    if(!empty($_GET['category'])){
        $keyword=$_GET['category'];
    }
    if(isset($_GET['layout'])){
        $imageURLs = getImageURLs($keyword, $_GET['layout']);
    } else {
        $imageURLs = getImageURLs($keyword);
    }
    
    $backgroundImage = $imageURLs[array_rand($imageURLs)];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Paxabay Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @import url('css/styles.css');
            
            body {
                background-image: url(<?=$backgroundImage?>);
            }
        </style>
    </head>
    <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        
        <h2>
            Type a keyword to display a slideshow
            with random images from Pixabay.com
        </h2>
        
        <form>
            <input type="text" name="keyword" placeholder="Type keyword"/>
            
            <input type="radio" id="lhorizontal" name="layout" value="horizontal"><label for="lhorizontal">Horizontal</label>
            <input type="radio" id="lvertical" name="layout" value="vertical"><label for="lvertical">Vertical</label>
            <select name="category">
                <option value="">Select One</option>
                <option value="ocean">Sea</option>
                <option value="forest">Forest</option>
                <option value="mountain">Mountain</option>
            </select>
            
            <input type="submit" value="Go!" name="submitButton"/>
        </form>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php
                for($i = 0; $i < 5; $i++){
                    do{
                        $rand = rand(0,count($imageURLs));
                    } while(!isset($imageURLs[$rand]));
                    
                    echo "<div class='item ".(($i==0)?"active":"")."'>";
                    echo "<img src=".$imageURLs[$rand]."/>";
                    echo "</div>";
                    unset($imageURLs[$rand]);
                }
                ?>
            </div>
        </div>
    </body>
</html>