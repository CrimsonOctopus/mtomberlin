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
    if (isset($_GET['addUserForm'])){
        //the administrator clicked on the "Add User" button
        $firstName = $_GET['firstName'];
        $lastName = $_GET['lastName'];
        $email    = $_GET['email'];
        $universityId = $_GET['universityID'];
        $phone    = $_GET['phone'];
        $gender   = $_GET['gender'];
        $role   = $_GET['role'];
        $deptId   = $_GET['deptID'];
        
        //"INSERT INTO `tc_user` (`userId`, `firstName`, `lastName`, `email`, `universityId`, `gender`, `phone`, `role`, `deptId`) VALUES (NULL, 'a', 'a', 'a', '1', 'm', '1', '1', '1');
        
        $sql = "INSERT INTO tc_user
                (firstName, lastName, email, universityId, gender, phone, role, deptId)
                VALUES
                (:fName, :lName, :email, :universityId, :gender, :phone, :role, :deptId)";
        $namedParameters = array();
        $namedParameters[':fName'] =  $firstName;
        $namedParameters[':lName'] =  $lastName;
        $namedParameters[':email'] =  $email;
        $namedParameters[':universityId'] =  $universityId;
        $namedParameters[':gender'] = $gender;
        $namedParameters[':phone']  = $phone;
        $namedParameters[':role']   = $role;
        $namedParameters[':deptId'] = $deptId;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        
        echo "User has been added successfully!";
            
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
               First Name: <input type="text" name="firstName" required><br>
               Last Name: <input type="text" name="lastName" required><br>
               Email: <input type="text" name="email" required><br>
               University ID: <input type="text" name="universityID" required><br>
               Phone: <input type="text" name="phone" required><br>
               Gender: <input type="radio" name="gender" value="M" id="genderM" required/><label for="genderM">Male</label>
                       <input type="radio" name="gender" value="F" id="genderF" required/><label for="genderF">Female</label>
                    Role:   <select name="role" required>
                            <option value="">Select One</option>
                            <option>Faculty</option>
                            <option>Student</option>
                            <option>Staff</option>
                            </select><br>
                Department: <select name="deptID" required>
                            <option value="">Select One</option>
                            <?php 
                                $departments = getDepartmentInfo();
                                foreach ($departments as $record) {
                                    echo "<option value='".$record['departmentId']."'> "  . $record['deptName'] . "</option>";
                                }
                            ?>
                            </select><br>
                <input type="submit" name="addUserForm" value="Add User">
           </form>
       </fieldset>

    </body>
</html>