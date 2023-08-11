<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM employee JOIN personalInformation AS pi ON employee.personID=pi.personID;');
$statement->execute();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Employees</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <h1> List of Employees</h1>
        <a href="./create.php">Add a new employee</a>
        <table>
            <thead>
                <tr>
                    <td>Employee ID</td>
                    <td>Id</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Date of Birth</td>
                    <td>Employee Type</td>
                    <td>Postal Code</td>
                    <td>Address</td>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["employeeID"]?></td>
                    <td><?= $row["personID"]?></td>
                    <td><?= $row["firstName"]?></td>
                    <td><?= $row["lastName"]?></td>
                    <td><?= $row["dateOfBirth"]?></td>
                    <td><?= $row["employeeType"]?></td>
                    <td><?= $row["postalCode"]?></td>
                    <td><?= $row["address"]?></td>
                    <td>
                        <a href="./delete.php?employeeID=<?= $row["employeeID"] ?>">Delete</a>
                        <a href="./edit.php?employeeID=<?= $row["employeeID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="../">Back to homepage</a>
    </body>
</html>