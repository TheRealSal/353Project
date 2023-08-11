<?php
require_once '../database.php';

if (isset($_GET["personID"]) && isset($_GET["infectionDate"])) {
    $personID = $_GET["personID"];
    $infectionDate = $_GET["infectionDate"];

    $deleteStatement = $conn->prepare("DELETE FROM infection 
                                       WHERE personID = :personID AND infectionDate = :infectionDate");

    $deleteStatement->bindParam(':personID', $personID);
    $deleteStatement->bindParam(':infectionDate', $infectionDate);

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
    <title>Delete Infection Record</title>
</head>
<body>
    <h1>Delete Infection Record</h1>
    <p>Are you sure you want to delete this infection record?</p>
    <form action="./delete.php" method="get">
        <input type="hidden" name="personID" value="<?= $_GET["personID"] ?>">
        <input type="hidden" name="infectionDate" value="<?= $_GET["infectionDate"] ?>">
        <input type="submit" value="Delete">
    </form>
    <a href="./">Cancel</a>
</body>
</html>
