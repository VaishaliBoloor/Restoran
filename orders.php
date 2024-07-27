<?php
  ob_start();
  require 'header.php';
?>


        <?php

          $sql = $conn->prepare("SELECT orders.*, user.*, checkout.*
          FROM ((orders
          INNER JOIN user ON orders.u_id = user.u_id AND NOT delivery = 'deliverd')
          INNER JOIN checkout ON checkout.u_id = orders.u_id AND approval = 1)");
          $sql->execute(); 

        ?>

      <div class="main-panel">
        <div class="content-wrapper">
    <div class="col-15">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> Verify Order Payments</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th> Order Id</th>
                    <th> Customer Name </th>
                    <th> Product </th>
                    <!-- <th> Payment </th> -->
                    <th>  Quantity </th>
                    <!-- <th> Payment Mode </th> -->
                    <th> Date & Time </th>
                    <th> Approval </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $p_id = $result['p_id'];
                        $stmt = $conn->prepare("SELECT name FROM products WHERE p_id = '$p_id'");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <tr>
                  <td> <?php echo  $result['o_id'];?> </td>
                    <td>
                      <img src="assets/images/faces/face1.jpg" alt="image" />
                      <span class="pl-2"><?php echo $result['name']; ?></span>
                    </td>
                    <!-- <td> 02312 </td> -->
                    <!-- <td> &#8377 14,500 </td> -->
                    <td> <?php echo  $row['name'];?> </td>
                    <td> <?php echo  $result['qty'];?> </td>
                    <!-- <td> Credit card </td> -->
                    <td> <?php echo $result['transdate'];?></td>
                    <td>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="u_id" value="<?php echo $result['u_id']; ?>">
                        <input type="hidden" name="transdate" value="<?php echo $result['p_id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $result['name']; ?>">
                        <input type="hidden" name="email" value="<?php echo $result['email']; ?>">
                        <?php
                        
                            if ($result['delivery'] == 'ordered') {
                                echo '<button name="approve" class="badge badge-outline-success" style="background-color:transparent;">Out of Dlivery</button>';
                            }
                            else if ($result['delivery'] == 'out of Delivery') {
                                echo '<button name="reject" class="badge badge-outline-primary" style="background-color:transparent;">Delivered</button>';
                            }

                        ?>
                      </form>
                    </td>
                  </tr>
                  <?php
                    }

                    if (isset($_GET['approve'])) {
                      $u_id = $_GET['u_id'];
                      $transdate = $_GET['transdate'];
                      $name = $_GET['name'];
                      $email = $_GET['email'];
                      $subject = "Out for Delivery";
                      $message = "Yow will be reciving order in 20 mns";
                      $sql1 = $conn->prepare("UPDATE orders SET delivery = 'out of Delivery' WHERE u_id = '$u_id' AND p_id = '$transdate'");
                      $sql1->execute();
                      if ($sql1) {
                        echo "<script> window.location.href = '../../mail/notify.php?nsme=" . $name . "&email=" . $email . "&subject=" . $subject . "&message=" . $message ."&val=3'</script>";
                        // header('location:orders.php');
                        exit;
                      }
                    }

                    if (isset($_GET['reject'])) {
                      $u_id = $_GET['u_id'];
                      $transdate = $_GET['transdate'];
                      $name = $_GET['name'];
                      $email = $_GET['email'];
                      $subject = "Order Delivered";
                      $message = "Thank you for your co-operation";
                      $sql2 = $conn->prepare("UPDATE orders SET delivery = 'deliverd' WHERE u_id = '$u_id' AND p_id = '$transdate'");
                      $sql2->execute();
                      if ($sql2) {
                        echo "<script> window.location.href = '../../mail/notify.php?nsme=" . $name . "&email=" . $email . "&subject=" . $subject . "&message=" . $message ."&val=3'</script>";
                        // header('location:orders.php');
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