<?php
require_once '../database.php';

if (isset($_POST["facilityName"]) && isset($_POST["postalCode"]) && isset($_POST["address"]) && isset($_POST["phoneNumber"]) && isset($_POST["website"]) && isset($_POST["ministryID"]) && isset($_POST["maximumCapacity"])) {
    $facilityName = $_POST["facilityName"];
    $postalCode = $_POST["postalCode"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phoneNumber"];
    $website = $_POST["website"];
    $ministryID = $_POST["ministryID"];
    $maximumCapacity = $_POST["maximumCapacity"];

    $insertStatement = $conn->prepare("INSERT INTO facility 
                                       (facilityName, postalCode, address, phoneNumber, website, ministryID, maximumCapacity)
                                       VALUES
                                       (:facilityName, :postalCode, :address, :phoneNumber, :website, :ministryID, :maximumCapacity)");

    $insertStatement->bindParam(':facilityName', $facilityName);
    $insertStatement->bindParam(':postalCode', $postalCode);
    $insertStatement->bindParam(':address', $address);
    $insertStatement->bindParam(':phoneNumber', $phoneNumber);
    $insertStatement->bindParam(':website', $website);
    $insertStatement->bindParam(':ministryID', $ministryID);
    $insertStatement->bindParam(':maximumCapacity', $maximumCapacity);

    if ($insertStatement->execute()) {
        header("Location: .");
        exit();
    } else {
        echo "Facility creation failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Facility</title>
</head>
<body>
    <h1>Add Facility</h1>
    <form action="./create.php" method="post">
        <label for="facilityName">Facility Name</label><br>
        <input type="text" name="facilityName" id="facilityName" required><br>

        <label for="postalCode">Postal Code</label><br>
        <input type="text" name="postalCode" id="postalCode" required><br>

        <label for="address">Address</label><br>
        <input type="text" name="address" id="address" required><br>

        <label for="phoneNumber">Phone Number</label><br>
        <input type="text" name="phoneNumber" id="phoneNumber" required><br>

        <label for="website">Website</label><br>
        <input type="text" name="website" id="website" required><br>

        <label for="ministryID">Ministry ID</label><br>
        <input type="text" name="ministryID" id="ministryID" required><br>

        <label for="maximumCapacity">Maximum Capacity</label><br>
        <input type="text" name="maximumCapacity" id="maximumCapacity" required><br>

        <input type="submit" value="Create">
    </form>
</body>
</html>
