<?php
require_once '../database.php';

$employeeID = $_GET["employeeID"];

$statement = $conn->prepare("SELECT * FROM employee WHERE employee.employeeID = :employeeID");
$statement->bindParam(":employeeID", $employeeID);
$statement->execute();
$employee = $statement->fetch(PDO::FETCH_ASSOC);


if (isset($_POST["personID"])) {
    $personID = $_POST["personID"];
    $employeeID = $_POST["employeeID"];
    $employeeType = $_POST["employeeType"];

    // Update data in the personalInformation table
    $personalInfoStatement = $conn->prepare("UPDATE personalInformation 
                                             SET firstName = :firstName, 
                                                 lastName = :lastName, 
                                                 dateOfBirth = :dateOfBirth, 
                                                 postalCode = :postalCode, 
                                                 address = :address, 
                                                 phoneNumber = :phoneNumber, 
                                                 email = :email, 
                                                 citizenship = :citizenship, 
                                                 medicareNumber = :medicareNumber, 
                                                 medicareExpirationDate = :medicareExpirationDate 
                                             WHERE personID = :personID");

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

    if ($personalInfoStatement->execute()) {
        // Update data in the employee table
        $employeeStatement = $conn->prepare("UPDATE employee 
                                             SET employeeType = :employeeType 
                                             WHERE employeeID = :employeeID");

        $employeeStatement->bindParam(':employeeType', $employeeType);
        $employeeStatement->bindParam(':employeeID', $employeeID);

        if ($employeeStatement->execute()) {
            header("Location: .");
        } else {
            echo "Error updating employee.";
        }
    } else {
        echo "Error updating personal information.";
    }
} else {
    $employeeID = $_GET["employeeID"];

    // Retrieve employee and personal information data for pre-filling the form
    $statement = $conn->prepare("SELECT * FROM employee 
                                 JOIN personalInformation AS pi ON employee.personID = pi.personID 
                                 WHERE employee.employeeID = :employeeID");
    $statement->bindParam(":employeeID", $employeeID);
    $statement->execute();
    $employee = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$employee) {
        echo "Employee not found.";
        exit();
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
        <label for="personID">Person ID</label>
        <input type="number" name="personID" id="personID" value="<?= $employee["personID"] ?>">

        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" value="<?= $employee["firstName"] ?>">

        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" value="<?= $employee["lastName"] ?>">

        <label for="dateOfBirth">Date of Birth</label>
        <input type="date" name="dateOfBirth" id="dateOfBirth" value="<?= $employee["dateOfBirth"] ?>">

        <label for="postalCode">Postal Code</label>
        <input type="text" name="postalCode" id="postalCode" value="<?= $employee["postalCode"] ?>">

        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?= $employee["address"] ?>">

        <label for="phoneNumber">Phone Number</label>
        <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $employee["phoneNumber"] ?>">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $employee["email"] ?>">

        <label for="citizenship">Citizenship</label>
        <input type="text" name="citizenship" id="citizenship" value="<?= $employee["citizenship"] ?>">

        <label for="medicareNumber">Medicare Number</label>
        <input type="text" name="medicareNumber" id="medicareNumber" value="<?= $employee["medicareNumber"] ?>">

        <label for="medicareExpirationDate">Medicare Expiration Date</label>
        <input type="date" name="medicareExpirationDate" id="medicareExpirationDate" value="<?= $employee["medicareExpirationDate"] ?>">

        <label for="employeeType">Employee Type</label>
        <input type="text" name="employeeType" id="employeeType" value="<?= $employee["employeeType"] ?>">

        <input type="hidden" name="employeeID" value="<?= $employeeID ?>">
        <input type="submit" value="Update">
    </form>
</body>

</html>
