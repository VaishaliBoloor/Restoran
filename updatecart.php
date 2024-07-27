<?php
    include 'config.php';

    $q = $_GET['q'];

    $id = $_GET['id'];

    $pid = $_GET['pi'];

    $stmt1 = $conn->prepare("UPDATE cart SET qty = '$q' WHERE u_id = '$id' AND p_id = '$pid'");
    $stmt1->execute();
    header('location:cart.php');
?>