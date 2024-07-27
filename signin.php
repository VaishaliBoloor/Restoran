<?php
    session_start();
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Starbelly - SignIn</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <?php
    if (isset($_POST['submit'])) {
        $email = test_input($_POST['email']);
        $pass = md5(test_input($_POST['password']));
            
        if (empty($_SESSION['email'])) {

            if (empty($email && $pass)) {
                echo "Enter all the values";
            }
            else {
                $stmt = $conn->prepare("SELECT u_id, email, password FROM user WHERE email = :email AND password = :pass");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':pass', $pass);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($result) {
                    $_SESSION['u_id'] = $result['u_id'];
                    $_SESSION['email'] = $email;
                    
                    header('location:index.php');
                }
                else {
                    echo "Email or password is wrong";
                }
            }
        }
        else {
            header('location:index.php');
        }
    }
    ?>
    <div class="container-xxl position-relative p-0 mt-5">
        <div class="container-xxl bg-dark text-center p-5">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="container-xxl p-5" method="post">
                <h1 class="text-warning">Sign In</h1>
                <input type="email" class="mt-3 p-1 w-50" style="height: 40px;" name="email" placeholder="Email"><br>
                <input type="password" class="mt-3 p-1 w-50" style="height: 40px;" name="password" placeholder="Password"><br>
                <br><a href="signup.php" class="">Dont have a account?</a><br>
                <input class="btn-primary border-0 mt-3 w-25" type="submit" name="submit" style="height: 40px;">
            </form>
        </div>
    </div>