<?php
require '../../../config.php';

// this file is for updating adding and updating food items

if (isset($_POST['add'])) {
    $name = test_input($_POST['name']);
    $category = test_input($_POST['category']);
    $price = test_input($_POST['price']);
    $discount = test_input($_POST['discount']);
    $description = test_input($_POST['description']);
    //image selecter
    $image = $_FILES['img']['name'];
    $tempimg = $_FILES['img']['tmp_name'];
    $folder = "../../../img/" . $image;

    if (!empty($name && $category && $price && $description && $image)) {
        $stmt = $conn->prepare("INSERT INTO products (name, category, price, discount, discription, image) VALUES ('$name', '$category', '$price', '$discount', '$description', '$image')");
        $stmt->execute();
        if (move_uploaded_file($tempimg, $folder)) {
            header('location:../addproducts.php');
            exit;
        }
        else {
            echo "failed to upload";
        }
    }
    else {
        echo "Enter all the details";
    }

}
?>
