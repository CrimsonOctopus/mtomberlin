<?php
    include 'inc/header.php';
    
     function getPetList() {
        include '../../dbconnection.php';
        $conn = getDatabaseConnection("c9");


        $sql = "SELECT *
                FROM adoptees"; 
                
                        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetchAll(PDO::FETCH_ASSOC);//expecting only one record

        return $record;
    }
?>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  style="background-color:#444444">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <?php
                
                $pets = getPetList();
                $i=0;
                foreach ($pets as $pet){
                    echo "<div class='carousel-item".(($i==0)?" active":"")."'>";
                    $i++;
                    echo "<img class='center-block' src='./img/".$pet['pictureURL']."' alt='First slide' style='height: 400px; margin: 0 auto'>";
                    echo "</div>";
                }
            
            ?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        
        <br><br>
        <a class="btn btn-outline-primary" href="adoptions.php" role="button">Adopt Now! </a>
        <br><br>
        <hr>
        
<?php
    include 'inc/footer.php';
?>