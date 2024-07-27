<?php
include '../../config.php';

$cid = $_GET['cid'];

$sql = $conn->prepare("SELECT * FROM carrier where c_id = '$cid'");
$sql->execute();
$row = $sql->fetch(PDO::FETCH_ASSOC);

$imagePath = '../../resume/' . $row['resume']; // Specify the path to the image on the server

// Set the appropriate headers
// header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename= ' . $row['resume']);

// Output the image content
readfile($imagePath);

$stmt = $conn->prepare("DELETE FROM carrier WHERE c_id = '$cid'");
$stmt->execute();
header('location:resumes.php');
?>