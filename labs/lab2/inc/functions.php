<?php
function displayWinnings($win){
    echo "<div id='output'>";
    if($win >= 0){
        switch($win){
            case 0:
                $winnings = 1000;
                break;
            case 1:
                $winnings = 500;
                break;
            case 2:
                $winnings = 250;
                break;
            case 2:
                $winnings = 10;
                break;
        }
        
        echo "<h2><b>You win $winnings tokens!</b></h2>";
    } else {
        echo "<h3><b>Try again!</b></h2>";
    }
    echo "</div>";
}

function displaySymbol($num, $last, $count){
    $randVal = rand(0,3);
    
    switch($randVal){
        case 0:
            $symbol = "seven";
            break;
        case 1:
            $symbol = "cherry";
            break;
        case 2:
            $symbol = "lemon";
            break;
        case 3:
            $symbol = "bar";
            break;
    }
    
    echo "<img id=reel$num src='img/$symbol.png' alt='$symbol' title='$symbol' width='70'/>";
    
    return $randVal;
}

function play(){
    $symbols = "seven";
    $count = 0;
    $last = -1;
    $randVal = -1;
    $tokens = 0;
    $win = -1;
    
    for($i = 0; $i < 3; $i+=1){
        $randVal = displaySymbol($i+1, $last, $count);
        
        if($randVal==$last){
            $count+=1;
        } else {
            $count = 0;
        }
        
        if($count >= 2){
            $win = $randVal;   
        }
        
        $last = $randVal;
        
    }
    
    displayWinnings($win);
}
?>