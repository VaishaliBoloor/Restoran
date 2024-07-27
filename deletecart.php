<?php

    include 'config.php';

    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM cart WHERE c_id = '$id'");
        $stmt->execute();
        header('location:cart.php');
    }

?>