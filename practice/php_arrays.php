<!DOCTYPE html>
<?php

function displaySymbol($symbol){
    echo "<img src='../labs/lab2/img/$symbol.png' width='70'/>";
}
    $symbols = array("lemon","cherry","sevens");
    
    print_r($symbols);
    displaySymbol($symbols[0]);
    $symbols[]="grapes";
    displaySymbol($symbols[3]);
    array_push($symbols,"orange");
    sort($symbols);
    print_r($symbols);
    rsort($symbols);
    print_r($symbols);
    shuffle($symbols);
    print_r($symbols);
    $lastsymbol = array_pop($symbols);
    echo $lastsymbol;
    print_r($symbols);
    
?>

<html>
    <head>
        <title> PHP Arrays </title>
    </head>
    <body>
        
    </body>
</html>