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
            ."<dt><h4>".$this->name."</h4></dt>"
            ."<dd><img src='".$this->image."' class='thumbnail'/>"
            ."<p>".$this->description
            ."<br><br>"
            ."<a href='./details.php?ship=".$this->name."'>Details</a>"
            ."</p></dd></dl>";
        }
        
        public function getName(){
            return $this->name;
        }
    }
    
    function initializeShips(){
        if(!isset($_SESSION['ships'])){
            $ships = array();
            $ship1 = new Ship("Prototron",'./img/ship1.jpg',"A fast, adaptable ship constructed from primitive components.");
            $ship2 = new Ship("Crusher",'./img/ship2.jpg',"An advanced military craft developed near the end of the war.");
            $ship3 = new Ship("Harbinger",'./img/ship3.jpg',"Capital ship of the Pliedan fleet, capable of laying waste to whole systems.");
            $ship4 = new Ship("Sythe",'./img/ship4.jpg',"Fast and nimble, cutting through swathes through the human fighter squadrons.");
            $ship5 = new Ship("Nova",'./img/ship5.jpg',"Equipped with a massively powerful beam capable of cutting through planet surface.");
            $ship6 = new Ship("Valor",'./img/ship6.jpg',"Designed to be used by the Imperial Knights before the destruction of humanity.");
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
    
    function persistTextBox($textBox){
        if(isset($_GET[$textBox])){
                $_SESSION[$textBox]=$_GET[$textBox];
        } else {
            unset($_SESSION[$textBox]);
        }
    }
    function generateShips($results,$keyword){
        $nums = array();
        $numShips = 5;
        if(!isset($keyword) || empty($keyword)){
            if($results >= $numShips){
                $results = $numShips;
            }
            $titleShown = false;
            for($i = 0; $i < $results; $i++){
                do{
                    $rand = rand(0,$numShips);
                    $found = in_array($rand,$nums);
                }while($found);
                $nums[] = $rand;
                $index = $rand;
                if(!$titleShown){
                    echo "<div id='ships'>"
                        ."<h2 class='heading'>Ships</h3>";
                    $titleShown = true;
                }
                    
                $ship = $_SESSION['ships'][$index];
                $ship->displayShip();
            }
            if($titleShown){
                echo "</div>";
            }
        } else {
            $titleShown = false;
            for($i = 0; $i < $numShips; $i++){
                if(strpos($_SESSION['ships'][$i]->getName(), $keyword) !== false){
                    $index = $i;
                    
                    if(!$titleShown){
                        echo "<div id='ships'>"
                            ."<h2 class='heading'>Ships</h3>";
                        $titleShown = true;
                    }
                    
                    $ships = $_SESSION['ships'][$index];
                    $ships->displayShip();
                }
            }
            if($titleShown){
                echo "</div>";
            }
        }
    }
    
    function generateStations($results,$keyword){
        $nums = array();
        $numStations = 5;
        if(!isset($keyword) || empty($keyword)){
            if($results >= $numStations){
                $results = $numStations;
            }
            $titleShown = false;
            for($i = 0; $i < $results; $i++){
                 do{
                    $rand = rand(0,$numStations);
                    $found = in_array($rand,$nums);
                }while($found);
                $nums[] = $rand;
                $index = $rand;
                
                if(!$titleShown){
                    echo "<div id='stations'>"
                        ."<h2 class='heading'>Stations</h3>";
                    $titleShown = true;
                }
                
                $stations = $_SESSION['stations'][$index];
                $stations->displayShip();
                
            }
            if($titleShown){
                echo "</div>";
            }
        } else {
            $titleShown = false;
            for($i = 0; $i < $numStations; $i++){
                if(strpos($_SESSION['stations'][$i]->getName(), $keyword) !== false){
                    $index = $i;
                    
                    if(!$titleShown){
                        echo "<div id='stations'>"
                            ."<h2 class='heading'>Stations</h3>";
                        $titleShown = true;
                    }
                    
                    $stations = $_SESSION['stations'][$index];
                    $stations->displayShip();
                }
            }
            if($titleShown){
                echo "</div>";
            }
        }
    }
    
    function generateSystems($results,$keyword){
        $nums = array();
        $numSystems = 5;
        if(!isset($keyword) || empty($keyword)){
            if($results >= $numSystems){
                $results = $numSystems;
            }
            
            $titleShown = false;
            for($i = 0; $i < $results; $i++){
                do{
                    $rand = rand(0,$numSystems);
                    $found = in_array($rand,$nums);
                }while($found);
                $nums[] = $rand;
                $index = $rand;
                
                if(!$titleShown){
                    echo "<div id='systems'>"
                        ."<h2 class='heading'>Systems</h3>";
                    $titleShown = true;
                }
                
                $systems = $_SESSION['systems'][$rand];
                $systems->displayShip();
            }
            if($titleShown){
                echo "</div>";
            }
        } else {
            $titleShown = false;
            for($i = 0; $i < $numSystems; $i++){
                if(strpos($_SESSION['systems'][$i]->getName(), $keyword) !== false){
                    $index = $i;
                    
                    if(!$titleShown){
                        echo "<div id='systems'>"
                            ."<h2 class='heading'>Systems</h3>";
                        $titleShown = true;
                    }
                    
                    $systems = $_SESSION['systems'][$index];
                    $systems->displayShip();
                }
            }
            if($titleShown){
                echo "</div>";
            }
        }
            
    }
?>