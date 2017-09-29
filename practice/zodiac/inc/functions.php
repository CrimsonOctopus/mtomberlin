<?php
    function generateList($startYear,$endYear){
        $sum = 0;
        $zodiac = array("rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig");
        $i = 0;
        for($year = $startYear; $year <= $endYear; $year++){
            echo "<li>";
            
            /*if($year>1900 && $year%4==0){*/
                if($i<11){
                    $i++;
                } else {
                    $i=0;
                }
                echo "<img src='./img/".$zodiac[$i].".png'>";
            //}
            
            echo "Year $year ";
            
            if($year%100==0) 
                echo "Happy New Century!";
                
            if($year==1776) 
                echo "USA INDEPENDENCE";
            echo"</li>";
            $sum+=$year;
        }
        return $sum;
    }
    
    function generateAndSum($startYear=1500,$endYear=2000){
        if(isset($_GET['startYear'])){
            $startYear=$_GET['startYear'];
        }
        
        if(isset($_GET['endYear'])){
            $endYear=$_GET['endYear'];
        }
        
        echo "<h1>Chinese Zodiac Table</h3>";
        echo "<ul>";
        $sum = generateList($startYear,$endYear);
        echo "</ul>";
        echo "<h3>Year Sum: $sum </h3>";
    }
?>