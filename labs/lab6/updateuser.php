<?php
    session_start();
    
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
        exit();
    }

    include '../../dbconnection.php';
    
    $conn = getDatabaseConnection();

    function getDepartmentInfo(){
        global $conn;
        $sql = "SELECT deptName, departmentId
                FROM `tc_department` 
                ORDER BY deptName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
    
    function getUserInfo($userId) {
        global $conn;
        $sql = "SELECT * 
                FROM tc_user
                WHERE userId = $userId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        print_r($record);
        return $record;
    }
    
    if(isset($_GET['updateUserForm'])){
        $sql = "UPDATE tc_user SET firstName = :fName, lastName = :lName, email = :email, universityId = :universityId, phone = :phone, gender = :gender, role= :role, deptId = :deptId WHERE userId = :userId";
        $namedParameters['fName'] = $_GET['firstName'];
        $namedParameters['lName'] = $_GET['lastName'];
        $namedParameters['email'] = $_GET['email'];
        $namedParameters['universityId'] = $_GET['universityID'];
        $namedParameters['phone'] = $_GET['phone'];
        $namedParameters['gender'] = $_GET['gender'];
        $namedParameters['role'] = $_GET['role'];
        $namedParameters['deptID'] = $_GET['deptID'];
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
    }
    
    if (isset($_GET['userId'])) {
        $userInfo = getUserInfo($_GET['userId']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Add User </title>
    </head>
    <body>
        
       <fieldset>
           <legend>Add New User</legend>
           
           <form>
               <input type="hidden" name="userId" value=<?= $userInfo['userId']?>>
               First Name: <input type="text" name="firstName" required value="<?=$userInfo['firstName']?>"><br>
               Last Name: <input type="text" name="lastName" required value="<?=$userInfo['lastName']?>"><br>
               Email: <input type="text" name="email" required value="<?=$userInfo['email']?>"><br>
               University ID: <input type="text" name="universityID" required value="<?=$userInfo['universityId']?>"><br>
               Phone: <input type="text" name="phone" required value="<?=$userInfo['phone']?>"><br>
               Gender: <input type="radio" name="gender" value="M" id="genderM" required <?=($userInfo['gender']=='M')? "checked" : ""?>/><label for="genderM">Male</label>
                       <input type="radio" name="gender" value="F" id="genderF" required <?=($userInfo['gender']=='F')? "checked" : ""?>/><label for="genderF">Female</label><br>
                Role:   <select name="role" required>
                        <option value="">Select One</option>
                        <option <?=($userInfo['role']=='Faculty')? "selected" : ""?>>Faculty</option>
                        <option <?=($userInfo['role']=='Student')? "selected" : ""?>>Student</option>
                        <option <?=($userInfo['role']=='Staff')? "selected" : ""?>>Staff</option>
                        </select><br>
                Department: <select name="deptID" required>
                            <option value="">Select One</option>
                            <?php 
                                $departments = getDepartmentInfo();
                                foreach ($departments as $record) {
                                    echo "<option value='".$record['departmentId']."'";
                                    echo (($userInfo['deptId']==$record['departmentId']) ? "selected" : "");
                                    echo ">"  . $record['deptName'] . "</option>";
                                }
                            ?>
                            </select><br>
                <input type="submit" name="updateUserForm" value="Update User">
           </form>
       </fieldset>

    </body>
</html>