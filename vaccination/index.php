<?php
require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM vaccine JOIN personalInformation AS pi ON vaccine.personID = pi.personID;');
$statement->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vaccination Records</title>
</head>
<body>
    <h1>List of Vaccination Records</h1>
    <a href="./create.php">Add a new vaccination record</a>
    <table>
        <thead>
            <tr>
                <td>Person ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Date of Birth</td>
                <td>Dose Number</td>
                <td>Vaccination Date</td>
                <td>Vaccine Type</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= $row["personID"] ?></td>
                <td><?= $row["firstName"] ?></td>
                <td><?= $row["lastName"] ?></td>
                <td><?= $row["dateOfBirth"] ?></td>
                <td><?= $row["doseNumber"] ?></td>
                <td><?= $row["vaccinationDate"] ?></td>
                <td><?= $row["vaccineType"] ?></td>
                <td>
                    <a href="./edit.php?personID=<?= $row["personID"] ?>&doseNumber=<?= $row["doseNumber"] ?>">Edit</a>
                    <a href="./delete.php?personID=<?= $row["personID"] ?>&doseNumber=<?= $row["doseNumber"] ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>
</html>
