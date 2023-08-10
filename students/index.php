<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM student JOIN personalInformation AS pi ON student.personID=pi.personID;');
$statement->execute();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Students</title>
    </head>
    <body>
        <h1> List of Students</h1>
        <a href="./create.php">Add a new student</a>
        <table>
            <thead>
                <tr>
                    <td>Student ID</td>
                    <td>Id</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Date of Birth</td>
                    <td>Current Level</td>
                    <td>Postal Code</td>
                    <td>Address</td>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["studentID"]?></td>
                    <td><?= $row["personID"]?></td>
                    <td><?= $row["firstName"]?></td>
                    <td><?= $row["lastName"]?></td>
                    <td><?= $row["dateOfBirth"]?></td>
                    <td><?= $row["currentLevel"]?></td>
                    <td><?= $row["postalCode"]?></td>
                    <td><?= $row["address"]?></td>
                    <td>
                        <a href="./delete.php?studentID=<?= $row["studentID"] ?>">Delete</a>
                        <a href="./edit.php?studentID=<?= $row["studentID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="../">Back to homepage</a>
    </body>
</html>