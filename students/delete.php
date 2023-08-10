<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM student WHERE studentID=:studentID;");
$statement->bindParam(":studentID", $_GET["studentID"]);
$statement->execute();

header("Location: .");

?>