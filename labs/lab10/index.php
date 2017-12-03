<?php
//print_r($_FILES);
echo "  <h2> Photo Gallery</h2> <br>";
function gall(){
echo"File Size " . $_FILES['myFile']['size'];
if($_FILES['myFile']['size'] > 114000){
      echo " <br> <h2> Image Too Big </h2>";
  // header('Location:index.php');
  
}
else{
   move_uploaded_file($_FILES["myFile"]["tmp_name"], "gallery/". $_FILES["myFile"]["name"] );
   
   $files = scandir("gallery/",1);
   for($i =0; $i < count($files)-2 ; $i++){
       echo "<img src='gallery/". $files[$i] . "' width='50' class='pics'>";
   }
}
}
?>
<!DOCTYPE html>
<html>
   <head>
       <title>Lab 10: Photo Gallery </title>
       <style>
           .pics:active {
               -webkit-transform: scale(7);
               -ms-transform: scale(7);
               transform: scale(7);
           }
       </style>
       <script>
           
       </script>
   </head>
   <body>

<form method="POST" enctype="multipart/form-data">

   <input type="file" name="myFile"/>
   <input type='submit' value='Upload File!' name="submit"/><br><br>
    <?=gall()?>
</form>
   </body>
</html>