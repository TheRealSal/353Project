<?php
require_once '../database.php';

if (isset($_POST["personID"]) && isset($_POST["doseNumber"])) {
    $personID = $_POST["personID"];
    $doseNumber = $_POST["doseNumber"];
    $vaccinationDate = $_POST["vaccinationDate"];
    $vaccineType = $_POST["vaccineType"];

    $updateStatement = $conn->prepare("UPDATE vaccine 
                                       SET vaccinationDate = :vaccinationDate, 
                                           vaccineType = :vaccineType 
                                       WHERE personID = :personID AND doseNumber = :doseNumber");

    $updateStatement->bindParam(':personID', $personID);
    $updateStatement->bindParam(':doseNumber', $doseNumber);
    $updateStatement->bindParam(':vaccinationDate', $vaccinationDate);
    $updateStatement->bindParam(':vaccineType', $vaccineType);

    if ($updateStatement->execute()) {
        header("Location: .");
        exit();
    } else {
        echo "Update failed.";
    }
} else {
    $personID = $_GET["personID"];
    $doseNumber = $_GET["doseNumber"];

    $statement = $conn->prepare("SELECT * FROM vaccine 
                                 WHERE personID = :personID AND doseNumber = :doseNumber");
    $statement->bindParam(':personID', $personID);
    $statement->bindParam(':doseNumber', $doseNumber);
    $statement->execute();
    $vaccination = $statement->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Vaccination Record</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Edit Vaccination Record</h1>
    <form action="./edit.php" method="post">
        <input type="hidden" name="personID" value="<?= $personID ?>">
        <input type="hidden" name="doseNumber" value="<?= $doseNumber ?>">
        
        <label for="vaccinationDate">Vaccination Date</label>
        <input type="date" name="vaccinationDate" id="vaccinationDate" value="<?= $vaccination["vaccinationDate"] ?>" required><br>
        
        <label for="vaccineType">Vaccine Type</label>
        <input type="text" name="vaccineType" id="vaccineType" value="<?= $vaccination["vaccineType"] ?>" required><br>
        
        <input type="submit" value="Update">
    </form>
    <a href="./">Cancel</a>
</body>
</html>
