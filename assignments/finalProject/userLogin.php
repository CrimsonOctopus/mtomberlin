<!DOCTYPE html>
<html lang="en-US">
<!--
Mathew Tomberlin
CSUMB CST 336
9/4/2017
mechanics.html
-->

<!-- This is the head -->
<!-- All styles and javascript go inside the head -->
    <head>
        <meta charset="utf-8"/>
        <title>Forum</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <script>
            function showRegister(){
                $("#loginForm").hide();
                $("#registerForm").show();
            }
            
            function hideRegister(){
                $("#registerForm").hide();
                $("#loginForm").show();
            }
            function showLogin(){
                $("#registerForm").hide();
                $("#loginForm").show();
            }
            
            function hideLogin(){
                $("#loginForm").hide();
                $("#registerForm").show();
            }
            
            $(document).ready(function(){
                hideRegister();
                showLogin();
            });
        </script>
    </head>
    
    <body>
        <nav>
            <div class="siteTitle">Forum</div>
            <hr>
            <div>
                <a href="index.php">Home</a>
            </div>
        </nav>
        
        <div id="forumBody">
            <div id="loginForm">
                <form method="POST" action="userLoginProcess.php">
                    <fieldset>
                        <legend>Login</legend>
                        <?php
                            if(isset($_GET["error"]) && $_GET["error"]=="true"){
                                echo "<b style='color:red'>Invalid username or password.</b><br><br>";
                            }
                        ?>
                        Username: <input type="text" name="username"/> <br />
                        Password: <input type="password" name="password"/> <br />
                        <input type="submit" name="login" value="Login"/><br><br>
                    </fieldset>
                </form>
                <button id="registerButton" onclick="showRegister()">Register Now</button>
            </div>
            
            <div id="registerForm">
                <form method="POST" action="userRegisterProcess.php" id="registerForm">
                    <fieldset>
                        <legend>Register</legend>
                        
                        Username: <input type="text" name="newusername"/> <br />
                        Password: <input type="password" name="newpassword"/> <br />
                        <input type="submit" name="register" value="Register"/><br><br>
                        <button id="loginButton" onclick="showLogin()">Login Now</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>