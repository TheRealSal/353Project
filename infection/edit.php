<?php
require_once '../database.php';

if (isset($_POST["personID"]) && isset($_POST["infectionDate"])) {
    $personID = $_POST["personID"];
    $infectionDate = $_POST["infectionDate"];
    $infectionType = $_POST["infectionType"];

    $updateStatement = $conn->prepare("UPDATE infection 
                                       SET infectionType = :infectionType 
                                       WHERE personID = :personID AND infectionDate = :infectionDate");

    $updateStatement->bindParam(':personID', $personID);
    $updateStatement->bindParam(':infectionDate', $infectionDate);
    $updateStatement->bindParam(':infectionType', $infectionType);

    if ($updateStatement->execute()) {
        header("Location: .");
        exit();
    } else {
        echo "Update failed.";
    }
} else {
    $personID = $_GET["personID"];
    $infectionDate = $_GET["infectionDate"];

    $statement = $conn->prepare("SELECT * FROM infection 
                                 WHERE personID = :personID AND infectionDate = :infectionDate");
    $statement->bindParam(':personID', $personID);
    $statement->bindParam(':infectionDate', $infectionDate);
    $statement->execute();
    $infection = $statement->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Infection Record</title>
</head>
<body>
    <h1>Edit Infection Record</h1>
    <form action="./edit.php" method="post">
        <input type="hidden" name="personID" value="<?= $personID ?>">
        <input type="hidden" name="infectionDate" value="<?= $infectionDate ?>">
        
        <label for="infectionType">Infection Type</label>
        <input type="text" name="infectionType" id="infectionType" value="<?= $infection["infectionType"] ?>" required><br>
        
        <input type="submit" value="Update">
    </form>
    <a href="./">Cancel</a>
</body>
</html>
