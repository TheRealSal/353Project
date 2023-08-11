<?php
require_once "../database.php";
$statement = $conn->prepare('SELECT * FROM facility');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Facilities</title>
</head>

<body>
  <h1>List of facilities</h1>
  <a href="./create.php">Add a new facility</a>
  <table>
    <thead>
      <tr>
        <td>facilityID</td>
        <td>facilityName</td>
        <td>postalCode</td>
        <td>address</td>
        <td>phoneNumber</td>
        <td>website</td>
        <td>maximumCapacity</td>
        <td>ministryID</td>
        <td>Action</td>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
          <td><?= $row["facilityID"]?></td>
          <td><?= $row["facilityName"]?></td>
          <td><?= $row["postalCode"]?></td>
          <td><?= $row["address"]?></td>
          <td><?= $row["phoneNumber"]?></td>
          <td><?= $row["website"]?></td>
          <td><?= $row["maximumCapacity"]?></td>
          <td><?= $row["ministryID"]?></td>
          <td>
            <a href="./delete.php?facilityID=<?= $row["facilityID"] ?>">Delete</a>
            <a href="./edit.php?facilityID=<?= $row["facilityID"] ?>">Edit</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <a href="../"> Back</a>
</body>

</html>
