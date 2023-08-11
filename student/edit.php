<?php
require_once '../database.php';

$studentID = $_GET["studentID"];

$statement = $conn->prepare("SELECT * FROM student WHERE student.studentID = :studentID");
$statement->bindParam(":studentID", $studentID);
$statement->execute();
$student = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["studentID"]) && isset($_POST["personID"]) && isset($_POST["currentLevel"])) {
    $updateStatement = $conn->prepare("UPDATE student 
                                       SET personID = :personID, 
                                           currentLevel = :currentLevel 
                                       WHERE studentID = :studentID");

    $updateStatement->bindParam(':studentID', $studentID);
    $updateStatement->bindParam(':personID', $_POST["personID"]);
    $updateStatement->bindParam(':currentLevel', $_POST["currentLevel"]);

    if ($updateStatement->execute()) {
        header("Location: .");
        exit();
    } else {
        echo "Update failed.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>

<body>

    <h1>Edit Student</h1>
    <form action="./edit.php?studentID=<?= $studentID ?>" method="post">

        <label for="personID">Person ID</label> <br>
        <input type="text" name="personID" id="personID" value="<?= $student["personID"] ?>"> <br>

        <label for="currentLevel">Current Level</label> <br>
        <input type="text" name="currentLevel" id="currentLevel" value="<?= $student["currentLevel"] ?>"> <br>

        <input type="hidden" name="studentID" value="<?= $studentID ?>">
        <input type="submit" value="Update">

    </form>
</body>

</html>
