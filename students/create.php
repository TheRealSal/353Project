<?php require_once '../database.php';

if(isset($_POST["studentID"])){
    $student = $conn->prepare("INSERT INTO student (studentID, personID, currentLevel)
                                VALUES (:studentID, :personID, currentLevel);");

    $student->bindParam(':studentID', $_POST["studentID"]);
    $student->bindParam(':personID', $_POST["personID"]);
    $student->bindParam(':currentLevel', $_POST["currentLevel"]);

    if($student->execute()) {
        header("Location: .");
    } else {

    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Add Student</title>
    </head>
    <body>
        <h1>Add Student</h1>
        <form action="./create.php" method="post">
            <label for="studentID">Student ID</label>
            <input type="number" name="studentID" id="studentID">
            <label for="personID">Person ID</label>
            <input type="number" name="personID" id="personID">
            <label for="currentLevel">Current Level</label>
            <input type="text" name="currentLevel" id="currentLevel">
        </form>
    </body>
</html>