<?php
  ob_start();
  require 'header.php';
?>


        <?php

          $sql = $conn->prepare("SELECT reserve.*, user.*
          FROM reserve
          INNER JOIN user ON reserve.u_id = user.u_id AND approval = 5");
          $sql->execute(); 

        ?>

      <div class="main-panel">
        <div class="content-wrapper">
    <div class="col-15">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Table Reservation Approval</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th> Customer Name </th>
                    <!-- <th> Order No </th> -->
                    <!-- <th> Payment </th> -->
                    <th> Members </th>
                    <th> Description </th>
                    <th> Date & Time </th>
                    <th> Approval </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {

                  ?>
                  <tr>
                    
                    <td>
                      <img src="assets/images/faces/face1.jpg" alt="image" />
                      <span class="pl-2"><?php echo $result['name']; ?></span>
                    </td>
                    <!-- <td> 02312 </td> -->
                    <!-- <td> &#8377 14,500 </td> -->
                    <td> <?php echo  $result['people'];?> </td>
                    <!-- <td> Credit card </td> -->
                    <td> <?php echo $result['description'];?></td>
                    <td> <?php echo $result['reservetime'];?></td>
                    <td>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="u_id" value="<?php echo $result['u_id']; ?>">
                        <input type="hidden" name="reservetime" value="<?php echo $result['reservetime']; ?>">
                        <input type="hidden" name="name" value="<?php echo $result['name']; ?>">
                        <input type="hidden" name="email" value="<?php echo $result['email']; ?>">
                        <button name="approve" class="badge badge-outline-success" style="background-color:transparent;">Approve</button>
                        <button name="reject" class="badge badge-outline-danger" style="background-color:transparent;">Reject</button>
                      </form>
                    </td>
                  </tr>
                  <?php
                    }

                    if (isset($_GET['approve'])) {
                      $u_id = $_GET['u_id'];
                      $reservetime = $_GET['reservetime'];
                      $name = $_GET['name'];
                      $email = $_GET['email'];
                      $subject = "Bokking Succesful";
                      $message = "Table is reserved for " . $reservetime;
                      $sql1 = $conn->prepare("UPDATE reserve SET approval = 1 WHERE u_id = '$u_id' AND reservetime = '$reservetime'");
                      $sql1->execute();
                      if ($sql1) {
                        echo "<script> window.location.href = '../../mail/notify.php?nsme=" . $name . "&email=" . $email . "&subject=" . $subject . "&message=" . $message ."&val=1'</script>";
                        // header('location:verify.php');
                        exit;
                      }
                    }

                    if (isset($_GET['reject'])) {
                      $u_id = $_GET['u_id'];
                      $reservetime = $_GET['reservetime'];
                      $sql2 = $conn->prepare("UPDATE reserve SET approval = 0 WHERE u_id = '$u_id' AND reservetime = '$reservetime'");
                      $sql2->execute();
                      if ($sql2) {
                        header('location:verify.php');
                        exit;
                      }
                    }
                    
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Restoran.com 2023</span>
            <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span> -->
            </div>
        </footer>
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>
</html>
<?php
ob_end_flush();
?>