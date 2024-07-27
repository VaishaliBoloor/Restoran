<?php
  session_start();
  require '../../config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
      
    <?php

    try {
      if (isset($_POST['submit'])) {
        $email = test_input($_POST['email']);
        $pass = md5(test_input($_POST['password']));
        
        if (empty($email && $pass)) {
          echo "Enter both the values";
        }
        else {
          $stmt = $conn->prepare("SELECT * FROM admin WHERE email=:email AND password=:password");
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':password', $pass);
          $stmt->execute();
          $num = $stmt->rowCount();
          if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['a_id'] = $row['a_id'];
            header('location:dashboard.php');
          }
          else {
            echo "Email or password is wrong";
          }
        }
      }
    }
    catch (exception $e) {
      echo "Error is". $e->getMessage();
    }

    ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        <!-- partial -->
          <div class="content-wrapper mt-5" style="height: 60vh;">
            <div class="row">
              <div class="col-6 grid-margin" style="margin: auto;">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Admin Login</h4>
                    <p class="card-description"> Pleaseende deatails as mentioned </p>

                    <form class="forms-sample" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../../assets/vendors/select2/select2.min.js"></script>
    <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../../assets/js/file-upload.js"></script>
    <script src="../../assets/js/typeahead.js"></script>
    <script src="../../assets/js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>