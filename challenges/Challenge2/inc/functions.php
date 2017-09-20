<?php
function displayWin($win){
    if($win == 0){
        echo "<h3 id='winner'><b>Player wins</b></h3>";
    } else if($win==1){
        echo "<h3 id='winner'><b>Computer wins</b></h2>";
    } else {
        echo "<h3 id='winner'><b>Tie!</b></h2>";
    }
}

function displayCard($person, $last, $count){
    $randSuite = rand(0,3);
    
    switch($randSuite){
        case 0:
            $suite = "clubs";
            break;
        case 1:
            $suite = "diamonds";
            break;
        case 2:
            $suite = "hearts";
            break;
        case 3:
            $suite = "spades";
            break;
    }
    
    $randValue = rand(0,4);
    
    switch($randValue){
        case 0:
            $card = "ten";
            break;
        case 1:
            $card = "jack";
            break;
        case 2:
            $card = "queen";
            break;
        case 3:
            $card = "king";
            break;
        case 4:
            $card = "ace";
            break;
    }
    if($person==0){
        $name="Player";
    } else {
        $name="Computer";
    }
    echo "<div class='playerName'>";
    echo "<h2 class='playerNameText'>$name</h2>";
    echo "<img id=person$person src='./img/cards/$suite/$card.png' alt='$card' title='$card' width='70'/>";
    echo "</div>";
    
    return $randValue;
}

function play(){
    $count = 0;
    $last = -1;
    $randVal = -1;
    $tokens = 0;
    $win = -1;
    
    echo "<div id='cardLayout'>";
    for($i = 0; $i < 2; $i+=1){
        $randVal = displayCard($i, $last, $count);
        if($i==1){
             if($randVal>$last){
                displayWin(1);
            } else if($randVal <$last) {
                displayWin(0);
            } else {
                displayWin(-1);
            }   
        }
        $last = $randVal;
        
    }
    echo "</div>";
}
?>