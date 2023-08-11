<?php
require_once '../database.php';

$employeeID = $_GET["employeeID"];

$statement = $conn->prepare("SELECT * FROM employee WHERE employee.employeeID = :employeeID");
$statement->bindParam(":employeeID", $employeeID);
$statement->execute();
$employee = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["employeeID"]) && isset($_POST["personID"]) && isset($_POST["employeeType"])) {
    $updateStatement = $conn->prepare("UPDATE employee 
                                       SET personID = :personID, 
                                           employeeType = :employeeType 
                                       WHERE employeeID = :employeeID");

    $updateStatement->bindParam(':employeeID', $employeeID);
    $updateStatement->bindParam(':personID', $_POST["personID"]);
    $updateStatement->bindParam(':employeeType', $_POST["employeeType"]);

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
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <h1>Edit Employee</h1>
    <form action="./edit.php?employeeID=<?= $employeeID ?>" method="post">

        <label for="personID">Person ID</label> <br>
        <input type="text" name="personID" id="personID" value="<?= $employee["personID"] ?>"> <br>

        <label for="employeeType">Employee Type</label> <br>
        <input type="text" name="employeeType" id="employeeType" value="<?= $employee["employeeType"] ?>"> <br>

        <input type="hidden" name="employeeID" value="<?= $employeeID ?>">
        <input type="submit" value="Update">

    </form>
</body>

</html>
