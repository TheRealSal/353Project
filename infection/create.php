<?php
require_once '../database.php';

if (isset($_POST["personID"]) && isset($_POST["infectionDate"]) && isset($_POST["infectionType"])) {
    $personID = $_POST["personID"];
    $infectionDate = $_POST["infectionDate"];
    $infectionType = $_POST["infectionType"];

    $insertStatement = $conn->prepare("INSERT INTO infection 
                                       (personID, infectionDate, infectionType)
                                       VALUES
                                       (:personID, :infectionDate, :infectionType)");

    $insertStatement->bindParam(':personID', $personID);
    $insertStatement->bindParam(':infectionDate', $infectionDate);
    $insertStatement->bindParam(':infectionType', $infectionType);

    if ($insertStatement->execute()) {
        header("Location: .");
        exit();
    } else {
        echo "Infection record creation failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Infection Record</title>
</head>
<body>
    <h1>Add Infection Record</h1>
    <form action="./create.php" method="post">
        <label for="personID">Person ID</label>
        <input type="number" name="personID" id="personID" required><br>

        <label for="infectionDate">Infection Date</label>
        <input type="date" name="infectionDate" id="infectionDate" required><br>

        <label for="infectionType">Infection Type</label>
        <input type="text" name="infectionType" id="infectionType" required><br>

        <input type="submit" value="Create">
    </form>
    <a href="../">Back to homepage</a>
</body>
</html>
