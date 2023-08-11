<?php
require_once '../database.php';

$studentID = $_GET["studentID"];

$statement = $conn->prepare("SELECT * FROM student JOIN personalInformation AS pi ON student.personID=pi.personID WHERE student.studentID = :studentID");
$statement->bindParam(":studentID", $studentID);
$statement->execute();
$student = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["personID"])) {
    $personID = $_POST["personID"];
    $studentID = $_POST["studentID"];

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
        // Update data in the student table
        $currentLevel = $_POST["currentLevel"];

        $studentStatement = $conn->prepare("UPDATE student 
                                             SET currentLevel = :currentLevel 
                                             WHERE studentID = :studentID");

        $studentStatement->bindParam(':studentID', $studentID);
        $studentStatement->bindParam(':currentLevel', $currentLevel);

        if ($studentStatement->execute()) {
            header("Location: .");
        } else {
            echo "Error updating student.";
        }
    } else {
        echo "Error updating personal information.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <h1>Edit Student</h1>
    <form action="./edit.php?studentID=<?= $studentID ?>" method="post">
        <label for="personID">Person ID</label>
        <input type="number" name="personID" id="personID" value="<?= $student["personID"] ?>">

        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName" value="<?= $student["firstName"] ?>">

        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName" value="<?= $student["lastName"] ?>">

        <label for="dateOfBirth">Date of Birth</label>
        <input type="date" name="dateOfBirth" id="dateOfBirth" value="<?= $studentData["dateOfBirth"] ?>">

        <label for="postalCode">Postal Code</label>
        <input type="text" name="postalCode" id="postalCode" value="<?= $studentData["postalCode"] ?>">

        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?= $studentData["address"] ?>">

        <label for="phoneNumber">Phone Number</label>
        <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $student["phoneNumber"] ?>">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $student["email"] ?>">

        <label for="citizenship">Citizenship</label>
        <input type="text" name="citizenship" id="citizenship" value="<?= $student["citizenship"] ?>">

        <label for="medicareNumber">Medicare Number</label>
        <input type="text" name="medicareNumber" id="medicareNumber" value="<?= $student["medicareNumber"] ?>">

        <label for="medicareExpirationDate">Medicare Expiration Date</label>
        <input type="date" name="medicareExpirationDate" id="medicareExpirationDate" value="<?= $student["medicareExpirationDate"] ?>">

        <label for="currentLevel">Current Level</label>
        <input type="text" name="currentLevel" id="currentLevel" value="<?= $student["currentLevel"] ?>">

        <input type="hidden" name="studentID" value="<?= $studentID ?>">
        <input type="submit" value="Update">
    </form>
</body>

</html>
