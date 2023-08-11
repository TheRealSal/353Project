<?php
require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM infection JOIN personalInformation AS pi ON infection.personID = pi.personID;');
$statement->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Infection Records</title>
</head>
<body>
    <h1>List of Infection Records</h1>
    <a href="./create.php">Add a new infection record</a>
    <table>
        <thead>
            <tr>
                <td>Person ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Date of Birth</td>
                <td>Infection Date</td>
                <td>Infection Type</td>
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
                <td><?= $row["infectionDate"] ?></td>
                <td><?= $row["infectionType"] ?></td>
                <td>
                    <a href="./edit.php?personID=<?= $row["personID"] ?>&infectionDate=<?= $row["infectionDate"] ?>">Edit</a>
                    <a href="./delete.php?personID=<?= $row["personID"] ?>&infectionDate=<?= $row["infectionDate"] ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>
</html>
