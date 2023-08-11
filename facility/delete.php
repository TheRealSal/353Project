<?php
require_once '../database.php';

$statement = $conn->prepare("DELETE FROM facility WHERE facilityID = :facilityID");
$statement->bindParam(":facilityID", $_GET["facilityID"]);

if ($statement->execute()) {
    header("Location: .");
    exit();
} else {
    echo "Deletion failed.";
}
?>
