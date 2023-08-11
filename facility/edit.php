<?php
require_once '../database.php';

$facilityID = $_GET["facilityID"];

$statement = $conn->prepare("SELECT * FROM facility WHERE facility.facilityID = :facilityID");
$statement->bindParam(":facilityID", $facilityID);
$statement->execute();
$facility = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["facilityID"]) && isset($_POST["facilityName"])) {
    $updateStatement = $conn->prepare("UPDATE facility 
                                       SET facilityName = :facilityName, 
                                           postalCode = :postalCode,
                                           address = :address,
                                           phoneNumber = :phoneNumber,
                                           website = :website,
                                           ministryID = :ministryID,
                                           maximumCapacity = :maximumCapacity 
                                       WHERE facilityID = :facilityID");

    $updateStatement->bindParam(':facilityID', $facilityID);
    $updateStatement->bindParam(':facilityName', $_POST["facilityName"]);
    $updateStatement->bindParam(':postalCode', $_POST["postalCode"]);
    $updateStatement->bindParam(':address', $_POST["address"]);
    $updateStatement->bindParam(':phoneNumber', $_POST["phoneNumber"]);
    $updateStatement->bindParam(':website', $_POST["website"]);
    $updateStatement->bindParam(':ministryID', $_POST["ministryID"]);
    $updateStatement->bindParam(':maximumCapacity', $_POST["maximumCapacity"]);

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
    <title>Edit Facility</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <h1>Edit facility</h1>
    <form action="./edit.php?facilityID=<?= $facilityID ?>" method="post">

        <label for="facilityName">Facility Name</label> <br>
        <input type="text" name="facilityName" id="facilityName" value="<?= $facility["facilityName"] ?>"> <br>

        <label for="postalCode">Postal Code</label> <br>
        <input type="text" name="postalCode" id="postalCode" value="<?= $facility["postalCode"] ?>"> <br>

        <label for="address">Address</label> <br>
        <input type="text" name="address" id="address" value="<?= $facility["address"] ?>"> <br>

        <label for="phoneNumber">Phone Number</label> <br>
        <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $facility["phoneNumber"] ?>"> <br>

        <label for="website">Website</label> <br>
        <input type="text" name="website" id="website" value="<?= $facility["website"] ?>"> <br>

        <label for="ministryID">Ministry ID</label> <br>
        <input type="text" name="ministryID" id="ministryID" value="<?= $facility["ministryID"] ?>"> <br>

        <label for="maximumCapacity">Maximum Capacity</label> <br>
        <input type="text" name="maximumCapacity" id="maximumCapacity" value="<?= $facility["maximumCapacity"] ?>"> <br>

        <input type="hidden" name="facilityID" value="<?= $facilityID ?>">
        <input type="submit" value="Update">

    </form>
</body>

</html>