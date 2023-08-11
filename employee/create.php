<?php
require_once '../database.php';

if (isset($_POST["firstName"])) {
    $personID = $_POST["personID"];
    $employeeID = $_POST["employeeID"];

    // Insert data into the personalInformation table
    $personalInfoStatement = $conn->prepare("INSERT INTO personalInformation 
                                                 (personID, firstName, lastName, dateOfBirth, postalCode, address, phoneNumber, email, citizenship, medicareNumber, medicareExpirationDate, employeeID, personType)
                                                 VALUES 
                                                 (:personID, :firstName, :lastName, :dateOfBirth, :postalCode, :address, :phoneNumber, :email, :citizenship, :medicareNumber, :medicareExpirationDate, :employeeID, :personType)");

    $personType = "EMPLOYEE";
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
    $personalInfoStatement->bindParam(':personType',$personType);
    $personalInfoStatement->bindParam(':employeeID',$employeeID);

    if ($personalInfoStatement->execute()) {
        // Insert data into the employee table
        $employeeType = $_POST["employeeType"];
        
        $employeeStatement = $conn->prepare("INSERT INTO employee (employeeID, personID, employeeType)
                                             VALUES (:employeeID, :personID, :employeeType)");

        $employeeStatement->bindParam(':employeeID', $employeeID);
        $employeeStatement->bindParam(':personID', $personID);
        $employeeStatement->bindParam(':employeeType', $employeeType);

        if ($employeeStatement->execute()) {
            header("Location: .");
        } else {
            echo "Error creating employee.";
        }
    } else {
        echo "Error creating personal information.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Add Employee</h1>
    <form action="./create.php" method="post">
        <label for="employeeID">Employee ID</label>
        <input type="number" name="employeeID" id="employeeID">

        <label for="personID">Person ID</label>
        <input type="number" name="personID" id="personID">

        <label for="employeeType">Employee Type</label>
        <input type="text" name="employeeType" id="employeeType">
        
        
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
        
        <label for="employeeType">Employee Type</label>
        <input type="text" name="employeeType" id="employeeType">
        
        <input type="submit" value="Create">
    </form>
</body>
</html>
