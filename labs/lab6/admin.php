<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}
include '../../dbconnection.php';
$conn = getDatabaseConnection();

function displayUsers() {
    global $conn;
    $sql = "SELECT * 
            FROM tc_user
            ORDER BY lastName";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    //print_r($users);
    return $users;
}

function showUsers($users){
    foreach($users as $user) {
        echo "<a href='viewuser.php?userId=".$user['userId']."'>".$user['firstName'] . "  " . $user['lastName']."</a>";
        echo "<form action='updateuser.php' style='display:inline'>";
        echo "<input type='hidden' name='userId' value='".$user['userId']."'>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
        
        echo "<form action='deleteuser.php' style='display:inline' onsubmit='return confirmDelete(\"".$user['firstName']."\")'>";
        echo "<input type='hidden' name='userId' value='".$user['userId']."'>";
        echo "<input type='submit' value='Delete'>";
        echo "</form>";
        echo "<br />";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            function confirmDelete(firstName){
                return confirm("Are you sure you want to delete "+firstName+"?");
            } 
        </script>
    </head>
    <body>
        <div class="jumbotron">
            <h1>TCP ADMIN PAGE</h1>
            <h2>Welcome <?= $_SESSION['adminFullName']?></h2>
        </div>
        
        <hr>
        <h3>Users</h3>
        <?php $users = displayUsers(); ?>
        <form action="adduser.php" style='display:inline'>
            <input type="submit" value="New User">
        </form>
        
        <form action="logout.php" style='display:inline'>
            <input type="submit" value="Logout">
        </form>
        <br>
        
        <?php showUsers($users); ?>
        </div>
    </body>
</html>