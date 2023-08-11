<?php
require_once '../database.php';

if (isset($_POST["studentID"])) {
    $studentID = $_POST["studentID"];
    $personID = $_POST["personID"];
    $currentLevel = $_POST["currentLevel"];

    // Insert data into the student table
    $studentStatement = $conn->prepare("INSERT INTO student (studentID, personID, currentLevel)
                                        VALUES (:studentID, :personID, :currentLevel)");

    $studentStatement->bindParam(':studentID', $studentID);
    $studentStatement->bindParam(':personID', $personID);
    $studentStatement->bindParam(':currentLevel', $currentLevel);

    // Insert data into the personalInformation table
    $personalInfoStatement = $conn->prepare("INSERT INTO personalInformation 
                                             (personID, firstName, lastName, dateOfBirth, postalCode, address, phoneNumber, email, citizenship, medicareNumber, medicareExpirationDate, studentID)
                                             VALUES 
                                             (:personID, :firstName, :lastName, :dateOfBirth, :postalCode, :address, :phoneNumber, :email, :citizenship, :medicareNumber, :medicareExpirationDate, :studentID)");

    $personalInfoStatement->bindParam(':personID', $personID);
    $personalInfoStatement->bindParam(':firstName', $_POST["firstName"]);
    $personalInfoStatement->bindParam(':lastName', $_POST["lastName"]);
    $personalInfoStatement->bindParam(':dateOfBirth', $_POST["dateOfBirth"]);
    $personalInfoStatement->bindParam(':postalCode', $_POST["postalCode"]);
    $personalInfoStatement->bindParam(':address', $_POST["address"]);
    $personalInfoStatement->bindParam(':phoneNumber', $_POST["phoneNumber"]);
    $personalInfoStatement->bindParam(':email', $_POST["email"]);
    $personalInfoStatement->bindParam(':citizenship', $_POST["citizenship"]);
    $personalInfoStatement->bindParam(':medicareNumber', $_POST["medicareNumber"]);
    $personalInfoStatement->bindParam(':medicareExpirationDate', $_POST["medicareExpirationDate"]);
    $personalInfoStatement->bindParam(':studentID', $studentID);

    if ($studentStatement->execute() && $personalInfoStatement->execute()) {
        header("Location: .");
    } else {
        echo "Error creating student and personal information.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="../style.css">
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
        
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName">
        
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName">
        
        <label for="dateOfBirth">Date of Birth</label>
        <input type="date" name="dateOfBirth" id="dateOfBirth">
        
        <label for="postalCode">Postal Code</label>
        <input type="text" name="postalCode" id="postalCode">
        
        <label for="address">Address</label>
        <input type="text" name="address" id="address">
        
        <label for="phoneNumber">Phone Number</label>
        <input type="text" name="phoneNumber" id="phoneNumber">
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        
        <label for="citizenship">Citizenship</label>
        <input type="text" name="citizenship" id="citizenship">
        
        <label for="medicareNumber">Medicare Number</label>
        <input type="text" name="medicareNumber" id="medicareNumber">
        
        <label for="medicareExpirationDate">Medicare Expiration Date</label>
        <input type="date" name="medicareExpirationDate" id="medicareExpirationDate">
        
        <input type="submit" value="Create">
    </form>
</body>
</html>
