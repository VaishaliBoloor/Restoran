<?php
    session_start();

    include 'config.php';
    $total = $_GET['tot'];
    if (isset($_POST['submit'])) {
        $name = test_input($_POST['name']);
        $phone = test_input($_POST['phone']);
        $address = test_input($_POST['address']);
        $city = test_input($_POST['city']);
        $pin = test_input($_POST['pincode']);

        $approval = 5;
        
        $u_id = $_SESSION['u_id'];

        $transid = test_input($_POST['transid']);

        if (empty($name && $phone && $address && $city && $pin && $transid)) {
            echo "<script> alert('Enter all the values') </script>";
            header("location:payment.php");
        }
        else {
            $stmt = $conn->prepare("INSERT INTO checkout (u_id, name, phone, address, city, pin, total, transid, transdate, approval) VALUES (:u_id, :name, :phone, :address, :city, :pin, :total, :transid, NOW(), :approval)");
            $stmt->bindParam(':u_id', $u_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':pin', $pin);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':transid', $transid);
            // $stmt->bindParam(':transdate', $transdate);
            // $stmt->bindParam(':now', NOW());
            $stmt->bindParam(':approval', $approval);
            $stmt->execute();
            
            if ($stmt) {
                $sql = $conn->prepare("INSERT INTO orders (c_id, p_id, u_id, qty, delivery) SELECT c_id, p_id, u_id, qty, 'ordered' FROM cart WHERE u_id = '$u_id'");
                $sql->execute();
                $sql1 = $conn->prepare("DELETE FROM cart WHERE u_id = '$u_id'");
                $sql1->execute();
                header('location:ordersuccesfull.php');
                exit;
            }
            else {
                echo "Error : " . $stmt->errorInfo()[2];
            }
        }
    }

?>