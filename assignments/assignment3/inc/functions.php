<?php
    session_start(); //start or resume a session
    
    class Ship{
        private $name = 'Prototron';
        private $image = './img/ship1.jpg';
        private $description = "This is a default ship.";
        
        public function __construct($name, $image, $description) {
            $this->name = $name;
            $this->image = $image;
            $this->description = $description;
        }
        
        public function displayShip(){
            echo "<dl>"
            ."<dt>".$this->name."</dt>"
            ."<dd><img src='".$this->image."' class='thumbnail'/>"
            ."<p>".$this->description
            ."<br><br>"
            ."<a href='./details.php?ship=".$this->name."'>Details</a>"
            ."</p></dd></dl>";
        }
    }
    
    function initializeShips(){
        if(!isset($_SESSION['ships'])){
            $ships = array();
            $ship1 = new Ship("Prototron",'./img/ship1.jpg',"This is the ship that the player begins with, hidden away on a remote planet with the last human cloning facility.");
            $ship2 = new Ship("Crusher",'./img/ship2.jpg',"The Crusher is an advanced military craft developed near the end of the war.");
            $ship3 = new Ship("Harbinger",'./img/ship3.jpg',"The capital ship of the Pliedan fleet, the Harbinger is capable of laying waste to whole systems.");
            $ship4 = new Ship("Sythe",'./img/ship4.jpg',"The Pliedan assault ship is fast and nimble, cutting through swathes through the human fighter squadrons.");
            $ship5 = new Ship("Nova",'./img/ship5.jpg',"This ship is equipped with a massively powerful beam capable of cutting through planet surface.");
            $ship6 = new Ship("Valor",'./img/ship6.jpg',"The Valor was a massive spacecraft designed to be used by the Imperial Knights before the destruction of humanity.");
            array_push($ships,$ship1);
            array_push($ships,$ship2);
            array_push($ships,$ship3);
            array_push($ships,$ship4);
            array_push($ships,$ship5);
            array_push($ships,$ship6);
            for($i = 0; $i < 6; $i++){
                $_SESSION['ships'][$i] = $ships[$i];   
            }
        }
    }
    
    function initializeStations(){
        if(!isset($_SESSION['station'])){
            $stations = array();
            $station1 = new Ship("Prometheus Station",'./img/station1.png',"Prometheus Station was the first interplanetary station built by humans.");
            $station2 = new Ship("Harrowing Station",'./img/station2.jpg',"Harrowing Station was a particularly dangerous station in it's time.");
            $station3 = new Ship("Hawk Station",'./img/station3.jpg',"Hawk Station was home of the violent and successful Hawk Fleet.");
            $station4 = new Ship("Lion Station",'./img/station4.jpg',"Lion Station was once the homebase to a massive fleet of space hulks.");
            $station5 = new Ship("Zebra Station",'./img/station5.jpg',"Zebra Station is hidden away between two supergiant stars.");
            $station6 = new Ship("Ceres Station",'./img/station6.jpg',"Ceres Station orbits a particularly large and recently unstable asteroid.");
            
            array_push($stations,$station1);
            array_push($stations,$station2);
            array_push($stations,$station3);
            array_push($stations,$station4);
            array_push($stations,$station5);
            array_push($stations,$station6);
            for($i = 0; $i < 6; $i++){
                $_SESSION['stations'][$i] = $stations[$i];   
            }
        }
    }
    
    function initializeSystems(){
        if(!isset($_SESSION['station'])){
            $systems = array();
            $system1 = new Ship("Orion System",'./img/system5.jpg',"The seat of human rule during the rein of mankind.");
            $system2 = new Ship("Zeus System",'./img/system2.jpg',"A powerful but isolated system.");
            $system3 = new Ship("Ares System",'./img/system1.jpg',"A system of war and conflict.");
            $system4 = new Ship("Posiedon System",'./img/system4.jpg',"A system of giant sea planets.");
            $system5 = new Ship("Hermes System",'./img/system3.jpg',"The system that once developed the human fleet.");
            $system6 = new Ship("Hephestus System",'./img/system3.jpg',"A system of factory planets.");
            
            array_push($systems,$system1);
            array_push($systems,$system2);
            array_push($systems,$system3);
            array_push($systems,$system4);
            array_push($systems,$system5);
            array_push($systems,$system6);
            for($i = 0; $i < 6; $i++){
                $_SESSION['systems'][$i] = $systems[$i];   
            }
        }
    }
    
    function persistCheckbox($checkboxName){
        if(isset($_GET[$checkboxName])){
            if($_GET[$checkboxName]=='on'){
                $_SESSION[$checkboxName.'On']=true;
            } else {
                $_SESSION[$checkboxName.'On']=false;
            }
        } else {
            $_SESSION[$checkboxName.'On']=false;
        }
    }
    
    function persistNumberBox($numberBox){
        if(isset($_GET[$numberBox])){
                $_SESSION[$numberBox]=$_GET[$numberBox];
        } else {
            unset($_SESSION[$numberBox]);
        }
    }

    function generateShips($results){
        $nums = array();
        $numShips = 5;
        if($results <= $numShips){
            for($i = 0; $i < $results; $i++){
                do{
                    $rand = rand(0,$numShips);
                    $found = in_array($rand,$nums);
                }while($found);
                $nums[] = $rand;
                
                $ship = $_SESSION['ships'][$rand];
                $ship->displayShip();
            }
        }
    }
    
    function generateStations($results){
        $nums = array();
        $numStations = 5;
        if($results <= $numStations){
            for($i = 0; $i < $results; $i++){
                do{
                    $rand = rand(0,$numStations);
                    $found = in_array($rand,$nums);
                }while($found);
                $nums[] = $rand;
                
                $stations = $_SESSION['stations'][$rand];
                $stations->displayShip();
            }
        }
    }
    
    function generateSystems($results){
        $nums = array();
        $numSystems = 5;
        if($results <= $numSystems){
            for($i = 0; $i < $results; $i++){
                do{
                    $rand = rand(0,$numSystems);
                    $found = in_array($rand,$nums);
                }while($found);
                $nums[] = $rand;
                
                $systems = $_SESSION['systems'][$rand];
                $systems->displayShip();
            }
        }
    }
?>