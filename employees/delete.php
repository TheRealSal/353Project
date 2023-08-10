<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM employee WHERE employeeID=:employeeID;");
$statement->bindParam(":employeeID", $_GET["employeeID"]);
$statement->execute();

header("Location: .");

?>