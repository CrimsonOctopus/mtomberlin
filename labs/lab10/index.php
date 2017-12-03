<!DOCTYPE html>
<html>
   <head>
       <title>Lab 10: Photo Gallery </title>
       <style>
           .zoomThumbnail:active {
               -webkit-transform: scale(3);
               -ms-transform: scale(3);
               transform: scale(3);
           }
           
           img {
               width:124px;
               height:124px;
               margin:4px;
           }
           
           fieldset {
               color: white;
               font-weight: bold;
               float:right;
               width:400px;
               margin-right:4px;
           }
           
           legend {
               font-weight: bold;
               color: white;
           }
           
           #warningFieldset{
               background-color:#550000;
           }
           
           .gallery {
               max-width:80%;
           }
           
           .warningDiv {
               float:right;
               text-align:center;
               color:red;
           }
           
           h2 {
               text-align:center;
               color:#0066FF;
           }
           
           body {
               background-color:#222222;
           }
           
           img {
               border-style:solid;
               border-width:5px;
               background-color:white;
           }
       </style>
   </head>
   <body>
        <h2>Public Photo Gallery</h2>
        <hr>
        <form method="POST" enctype="multipart/form-data">
            <fieldset id="fileUpload">
                <legend>File Upload</legend>
                <input type="file" name="myFile"/>
                <input type='submit' value='Upload File!' name="submit"/>
            </fieldset>
        </form>
        <br><br><br><br>
                <?php
                    //Upload image if under max size
                    if($_FILES['myFile']['size'] > 114000){
                        echo "<div class='warningDiv'>".
                             "<fieldset id='warningFieldset'>";
                        echo " <br> <h2> Image Too Big </h2>";
                        echo "File Size: " . $_FILES['myFile']['size'] . " bytes/114000 bytes";
                        echo "</fieldset>".
                             "</div>";
                    } else {
                        if(isset($_FILES['myFile'])){
                            move_uploaded_file($_FILES["myFile"]["tmp_name"], "gallery/". $_FILES["myFile"]["name"] );
                        }
                    }
                ?>
        
        <div class="gallery">
        <?php
            //Show gallery
            $files = scandir("gallery/",1);
            for($i =0; $i < count($files)-2 ; $i++){
                echo "<img src='gallery/". $files[$i] . "' width='50' class='zoomThumbnail'>";
            }
        ?>
        </div>
   </body>
</html>