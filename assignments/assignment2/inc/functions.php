<?php
    function generateShip(){
        $ships = array();
        for($i = 0; $i < 4; $i++){
            do{
                $ships[$i]="";
                $rand = rand(0,5);
                switch($rand){
                    case 0:
                        $ships[$i] = "<dl><dt>Prototron</dt><dd><img src='./img/ship1.jpg' class='thumbnail'/> <p>This is the ship that the player begins with, hidden away on a remote planet with the last human cloning facility.</p></dd></dl>";
                        break;
                    case 1:
                        $ships[$i] = "<dl><dt>Crusher</dt><dd><img src='./img/ship2.jpg' class='thumbnail'/> <p>The Crusher is an advanced military craft developed near the end of the war.</p></dd></dl>";
                        break;
                    case 2:
                        $ships[$i] = "<dl><dt>Harbinger</dt><dd><img src='./img/ship3.jpg' class='thumbnail'/> <p>The capital ship of the Pliedan fleet, the Harbinger is capable of laying waste to whole systems.</p></dd></dl>";
                        break;
                    case 3:
                        $ships[$i] = "<dl><dt>Sythe</dt><dd><img src='./img/ship4.jpg' class='thumbnail'/> <p>The Pliedan assault ship is fast and nimble, cutting through swathes through the human fighter squadrons.</p></dd></dl>";
                        break;
                    case 4:
                        $ships[$i] = "<dl><dt>Valor</dt><dd><img src='./img/ship5.jpg' class='thumbnail'/> <p>The Valor was designed to be used by the Imperial Knights before the destruction of humanity and is a massive spacecraft carrier.</p></dd></dl>";
                        break;
                    case 5:
                        $ships[$i] = "<dl><dt>Nova</dt><dd><img src='./img/ship1.jpg' class='thumbnail'/> <p>This ship is equiped with a massively powerful beam capable of cutting through planet surface.</p></dd></dl>";
                        break;   
                }
            }while($i > 0 && $ships[$i]==$ships[$i-1]);
        }
        
        for($i = 0; $i < 4; $i++){
            echo array_pop($ships);
        }
    }
    
    function generateStations(){
        $stations = array();
        for($i = 0; $i < 4; $i++){
            do{
                $stations[$i]="";
                $rand = rand(0,5);
                switch($rand){
                    case 0:
                        $stations[$i] = "<dl><dt>Ceres Station</dt><dd><img src='./img/station1.png' class='thumbnail'/>This is the ship that the player begins with, hidden away on a remote planet with the last human cloning facility.</dd></dl>";
                        break;
                    case 1:
                        $stations[$i] = "<dl><dt>Prometheus Station</dt><dd><img src='./img/station2.jpg' class='thumbnail'/>The Crusher is an advanced military craft developed near the end of the war.</dd></dl>";
                        break;
                    case 2:
                        $stations[$i] = "<dl><dt>Harrowing Station</dt><dd><img src='./img/station3.jpg' class='thumbnail'/>The capital ship of the Pliedan fleet, the Harbinger is capable of laying waste to whole systems.</dd></dl>";
                        break;
                    case 3:
                        $stations[$i] = "<dl><dt>Hawk Station</dt><dd><img src='./img/station4.jpg' class='thumbnail'/>The Pliedan assault ship is fast and nimble, cutting through swathes through the human fighter squadrons.</dd></dl>";
                        break;
                    case 4:
                        $stations[$i] = "<dl><dt>Lion Station</dt><dd><img src='./img/station1.png' class='thumbnail'/>The Valor was designed to be used by the Imperial Knights before the destruction of humanity and is a massive spacecraft carrier.</dd></dl>";
                        break;
                    case 5:
                        $stations[$i] = "<dl><dt>Zebra Station</dt><dd><img src='./img/station2.jpg' class='thumbnail'/>This ship is equiped with a massively powerful beam capable of cutting through planet surface.</dd></dl>";
                        break;   
                }
            }while($i > 0 && $stations[$i]==$stations[$i-1]);
        }
        
        rsort($stations);
        
        for($i = 0; $i < 4; $i++){
            echo array_pop($stations);
        }
    }
    
    function generateSystems(){
        $systems = array();
        for($i = 0; $i < 4; $i++){
            do {
                $systems[$i]="";
                $rand = rand(0,5);
                switch($rand){
                    case 0:
                        $systems[$i] = "<dl><dt>Orion</dt><dd>A system rich in minerals.</dd></dl>";
                        break;
                    case 1:
                        $systems[$i] = "<dl><dt>Zeus</dt><dd>A system of planets with violent volcanoes.</dd></dl>";
                        break;
                    case 2:
                        $systems[$i] = "<dl><dt>Ares</dt><dd>A system at war with itself.</dd></dl>";
                        break;
                    case 3:
                        $systems[$i] = "<dl><dt>Posiedon</dt><dd>A system of watery planets.</dd></dl>";
                        break;
                    case 4:
                        $systems[$i] = "<dl><dt>Hermes</dt><dd>The system that once developed the human fleet.</dd></dl>";
                        break;
                    case 5:
                        $systems[$i] = "<dl><dt>Hephestus</dt><dd>A system of factory planets.</dd></dl>";
                        break;   
                }
            } while($i > 0 && $systems[$i]==$systems[$i-1]);
        }
        
        shuffle($systems);
        
        for($i = 0; $i < 4; $i++){
            echo array_pop($systems);
        }
    }
?>