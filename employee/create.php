<?php require_once '../database.php';

if(isset($_POST["employeeID"])){
    $employee = $conn->prepare("INSERT INTO employee (employee, personID, employeeType)
                                VALUES (:studentID, :personID, currentLevel);");

    $employee->bindParam(':employeeID', $_POST["employeeID"]);
    $employee->bindParam(':personID', $_POST["personID"]);
    $employee->bindParam(':currentLevel', $_POST["currentLevel"]);

    if($employee->execute()) {
        header("Location: .");
    } else {

    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Add Employee</title>
    </head>
    <body>
        <h1>Add Employee</h1>
        <form action="./create.php" method="post">
            <label for="employeeID">Employee ID</label>
            <input type="number" name="employeeID" id="employeeID">
            <label for="personID">Person ID</label>
            <input type="number" name="personID" id="personID">
            <label for="currentLevel">Current Level</label>
            <input type="text" name="currentLevel" id="currentLevel">
        </form>
    </body>
</html>