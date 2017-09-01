<!DOCTYPE html>
<html>
<!--

First Website
and comment
in html
(comments can span multiple lines)

-->

<!-- This is the head -->
<!-- All styles and javascript go inside the head -->
    <head>
        <meta charset="utf-8"/>
        <title>Mathew Tomberlin: A Portfolio Story</title>
        <!--INTERNAL STYLE EXAMPLE
        <style>
            body {
                background-color:#000066 !important;
            }
        </style>-->
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    </head>
<!-- closing head -->

    <!-- This is the body -->
    <!-- This is where we place the content of our website -->
    <body> <!--INLINE STYLE EXAMPLE style="background-color:black; color:white;"-->
        <header> 
            <h1>Mathew Tomberlin</h1>
        </header>
        
        <nav>
            <hr width="50%"/>
            <a href="index.php" style="color:red;">Home</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
        
        <br/><br/>
        
        <main>
            <figure id="me">
                <img src="img/juan_doe.png" alt="Picture of Mathew Tomberlin"/>
            </figure>
            
            <div id="welcomeText">
                Hello!<br/>
                <p>Thank you for visiting my portfolio website!</p>
                <p>Ama a software engineer who was recently hired at Acme Corporation!</p>
                <p>Feel free to contact me!</p>
                
                <br/><br/>
                <em>"With ordinary talent and extraordinary <strong>perseverance</strong>, all things are attainable"</em></br>
            </div>
        </main>
        
        <!-- This is the footer -->
        <!-- The footer goes inside the body but not always -->
        <footer>
            <img src="img/Logo.PNG"/>
            CST336. 2017&copy; Tomberlin<br/>
            <strong>Disclaimer:</strong>The information in this wepage is fictitious. <br/>
            It is for academic uses only.
        </footer>
        <!-- closing footer -->
        
    </body>
    <!-- closing body -->

</html>