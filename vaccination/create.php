<?php
require_once '../database.php';

if (isset($_POST["personID"]) && isset($_POST["doseNumber"]) && isset($_POST["vaccinationDate"]) && isset($_POST["vaccineType"])) {
    $personID = $_POST["personID"];
    $doseNumber = $_POST["doseNumber"];
    $vaccinationDate = $_POST["vaccinationDate"];
    $vaccineType = $_POST["vaccineType"];

    $insertStatement = $conn->prepare("INSERT INTO vaccine 
                                       (personID, doseNumber, vaccinationDate, vaccineType)
                                       VALUES
                                       (:personID, :doseNumber, :vaccinationDate, :vaccineType)");

    $insertStatement->bindParam(':personID', $personID);
    $insertStatement->bindParam(':doseNumber', $doseNumber);
    $insertStatement->bindParam(':vaccinationDate', $vaccinationDate);
    $insertStatement->bindParam(':vaccineType', $vaccineType);

    if ($insertStatement->execute()) {
        header("Location: .");
        exit();
    } else {
        echo "Vaccination record creation failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Vaccination Record</title>
</head>
<body>
    <h1>Add Vaccination Record</h1>
    <form action="./create.php" method="post">
        <label for="personID">Person ID</label>
        <input type="number" name="personID" id="personID" required><br>

        <label for="doseNumber">Dose Number</label>
        <input type="number" name="doseNumber" id="doseNumber" required><br>

        <label for="vaccinationDate">Vaccination Date</label>
        <input type="date" name="vaccinationDate" id="vaccinationDate" required><br>

        <label for="vaccineType">Vaccine Type</label>
        <input type="text" name="vaccineType" id="vaccineType" required><br>

        <input type="submit" value="Create">
    </form>
    <a href="../">Back to homepage</a>
</body>
</html>
