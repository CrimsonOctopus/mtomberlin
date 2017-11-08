<html>
    <head>
        <title>Snake</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <style type="text/css">
            body {
                background-color: silver;
            }
            #startMenu {
                position: relative;
                width: 500px;
                height: 300px;
                margin: 0 auto;
                background-color: black;
                color: white;
            }
            #gameWindow {
                position: relative;
                width: 500px;
                height: 300px;
                margin: 0 auto;
                background-color: black;
                color: white;
            }
            #snakeHead {
                position: absolute;
                width: 25px;
                height: 25px;
                top: 10px;
                left: 5px;
            }
            
            .pellet {
                position: absolute;
                width: 25px;
                height: 25px;
                top: 10px;
                left: 5px;
            }
            .button {
                color: black;
                background-color:#FF6600;
                border-radius:8px;
                text-align:center;
                font-size:30px;
                font-family: "Lucida Console", Monaco, monospace;
                cursor:hand;
                cursor:pointer;
            }
            .noSelect {
                -moz-user-select: none;
                -webkit-user-select: none;
                user-select:none;
                -o-user-select:none;
                -khtml-user-select:none;
            }
            #startBtn {
                position: absolute;
                width: 100px;
                height: 30px;
                bottom: 50%;
                left: 50%;
            }
            #upBtn {
                position: absolute;
                width: 25px;
                height: 25px;
                bottom: 60px;
                right: 35px;
            }
            #downBtn {
                position: absolute;
                width: 25px;
                height: 25px;
                bottom: 10px;
                right: 35px;
            }
            #leftBtn {
                position: absolute;
                width: 25px;
                height: 25px;
                bottom: 35px;
                right: 60px;
            }
            #rightBtn {
                position: absolute;
                width: 25px;
                height: 25px;
                bottom: 35px;
                right: 10px;
            }
            
            #log{
                position: absolute;
                top: 5px;
                right: 5px;
            }
        </style>
        <script>
        
        function Point(x, y) {
          this.x = x;
          this.y = y;
        }
            var headPositionX= 100;
            var headPositionY = 100;
            var playerHealth = 100;
            var facingX = 0;
            var facingY = 0;
            var speed = 10;
            var numPellets = 0;
            var points=0;
            var pellets = [];
            var playerWeapon = "Sword";
            var gameTimer;
            var gameState = "Starting";
            
            function moveUp(){
                facingY = -1;
                facingX = 0;
            }
            
            function moveDown(){
                facingY = 1;
                facingX = 0;
            }
            
            function moveLeft(){
                facingY = 0;
                facingX = -1;
            }
            
            function moveRight(){
                facingY = 0;
                facingX = 1;
            }
            
            function incrementPoints(amount){
                points+=amount;
                $("#points").html(points);
            }
            
            function startGame(){
                $("#gameWindow").empty();
                
                $("#gameWindow").append('<img id="snakeHead" src="1.png">');
                $("#gameWindow").append('<div id="upBtn" class="button noSelect" onClick="moveUp();">^</div>');
                $("#gameWindow").append('<div id="downBtn" class="button noSelect" onClick="moveDown();">v</div>');
                $("#gameWindow").append('<div id="leftBtn" class="button noSelect" onClick="moveLeft();"><</div>');
                $("#gameWindow").append('<div id="rightBtn" class="button noSelect" onClick="moveRight();">></div>');
                $("#gameWindow").append('<div id="points"></div><div id="log"></div>');
                
                document.getElementById('snakeHead').style.top = headPositionY;
                document.getElementById('snakeHead').style.left = headPositionX;
                
                gameState = "Running";
                
                numPellets = 0;
                speed = 10;
                points = 0;
                incrementPoints(0);
                
                gameTimer = setInterval(gameLoop,100);
            }
            
            function gameLoop(){
                headPositionX = headPositionX+(speed*facingX);
                headPositionY = headPositionY+(speed*facingY);
                
                document.getElementById('snakeHead').style.left = headPositionX;
                document.getElementById('snakeHead').style.top = headPositionY;
                
                if(numPellets <= 0){
                    pellets.push(new Point(Math.random()*475,Math.random()*275));
                    numPellets=1;
                    
                    $("#gameWindow").append('<img id="pellet'+numPellets+'" class="pellet" src="1.png">');
                    document.getElementById('pellet'+numPellets).style.left = pellets[0].x;
                    document.getElementById('pellet'+numPellets).style.top = pellets[0].y;
                }
                
                if(headPositionX < 0 || headPositionX >= 475 || headPositionY < 0 || headPositionY >= 275){
                    clearInterval(gameTimer);
                    
                    $("#gameWindow").empty();
                    
                    gameState = "Starting";
                    headPositionX= 100;
                    headPositionY = 100;
                    facingX = 0;
                    facingY = 0;
                    speed = 10;
                    gameTimer = 0;
                    
                    $("#gameWindow").append('<div id="startMenu"><div id="startBtn" class="button noSelect" onClick="startGame();">Start</div></div>');
                }
                
                for(i = 0; i < numPellets; i++){
                    if(Math.abs((pellets[i].x+12)-(headPositionX+12))<=25 && Math.abs((pellets[i].y+12)-(headPositionY+12)) <= 25){
                        incrementPoints(10);
                        numPellets-=1;
                        speed+=2;
                        if(numPellets < 0){
                            numPellets=0;
                        }
                        pellets.splice(i,1);
                        $(".pellet").remove();
                    }
                }
            }
        </script>
    </head>
    <body>
            <div id="gameWindow">
                <div id="startMenu">
                    <div id="startBtn" class="button noSelect" onClick="startGame();">Start</div>
                    </div>
            </div>
    </body>
</htm>