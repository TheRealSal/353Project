<?php
require_once '../database.php';

if (isset($_GET["personID"]) && isset($_GET["doseNumber"])) {
    $personID = $_GET["personID"];
    $doseNumber = $_GET["doseNumber"];

    $deleteStatement = $conn->prepare("DELETE FROM vaccine 
                                       WHERE personID = :personID AND doseNumber = :doseNumber");

    $deleteStatement->bindParam(':personID', $personID);
    $deleteStatement->bindParam(':doseNumber', $doseNumber);

    if ($deleteStatement->execute()) {
        header("Location: .");
        exit();
    } else {
        echo "Deletion failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Vaccination Record</title>
</head>
<body>
    <h1>Delete Vaccination Record</h1>
    <p>Are you sure you want to delete this vaccination record?</p>
    <form action="./delete.php" method="get">
        <input type="hidden" name="personID" value="<?= $_GET["personID"] ?>">
        <input type="hidden" name="doseNumber" value="<?= $_GET["doseNumber"] ?>">
        <input type="submit" value="Delete">
    </form>
    <a href="./">Cancel</a>
</body>
</html>
