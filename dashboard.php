<?php 

  include 'header.php';
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Revenue</h5>
                    <div class="row">
                      <?php

                        $main = $conn->prepare("SELECT SUM(total), COUNT(co_id) FROM checkout");
                        $main->execute();
                        $ma = $main->fetch(PDO::FETCH_ASSOC);

                      ?>
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">&#8377 <?php echo $ma['SUM(total)']; ?></h2>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p> -->
                        </div>
                        <!-- <h6 class="text-muted font-weight-normal">11.38% Since last 3 month</h6> -->
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Sales</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"> <?php echo $ma['COUNT(co_id)']; ?></h2>
                          <!-- <p class="text-success ml-2 mb-0 font-weight-medium">+8.3%</p> -->
                        </div>
                        <!-- <h6 class="text-muted font-weight-normal"> 9.61% Since last 3 month</h6> -->
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <?php
                    $main1 = $conn->prepare("SELECT COUNT(r_id) FROM reserve WHERE approval = 1");
                    $main1->execute();
                    $ma1 = $main1->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <div class="card-body">
                    <h5>Total Reserves</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"> <?php echo $ma1['COUNT(r_id)']; ?></h2>
                          <!-- <p class="text-danger ml-2 mb-0 font-weight-medium">-2.1% </p> -->
                        </div>
                        <!-- <h6 class="text-muted font-weight-normal">2.27% Since last 3 month</h6> -->
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="row ">
                    <div class="col-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Table Reservation</h4>
                          <div class="table-responsive">
                            <?php 
                              $sql = $conn->prepare("SELECT reserve.*, user.name 
                              FROM reserve
                              INNER JOIN user ON reserve.u_id = user.u_id AND approval = 1 OR approval = 0");
                              $sql->execute(); 
                            ?>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th> Customer Name </th>
                                  <th> Members </th>
                                  <!-- <th> Payment </th> -->
                                  <!-- <th> Members </th>
                                  <th> Payment Mode </th> -->
                                  <th> Date & Time </th>
                                  <th> Status </th>
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
                                  <td> <?php echo $result['people']; ?> </td>
                                  <!-- <td> Credit card </td> -->
                                  <td> <?php echo $result['reservetime'] ?> </td>
                                  <td>
                                    <?php
                                    if ($result['approval'] == 1) {
                                    echo "<div class='badge badge-outline-success'>Approved</div>";
                                    }
                                    else {
                                      echo "<div class='badge badge-outline-danger'>Rejeted</div>";
                                    }
                                    ?>
                                  </td>
                                </tr>
                                <?php
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
            </div>
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Payment Status</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Sl. No</th>
                            <th> Customer Name </th>
                            <th> Checkout Id </th>
                            <th> Product Cost </th>
                            <th> Date </th>
                            <th> Payment Status </th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                            $no = 0;
                            $stmt = $conn->prepare("SELECT * FROM checkout");
                            $stmt->execute();
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                  $no += 1;
                                  $u_id = $row['u_id'];
                                  $stmt1 = $conn->prepare("SELECT name FROM user WHERE u_id = '$u_id'");
                                  $stmt1->execute();
                                  $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                          ?>

                          <tr>
                            <td><?php echo $no ?></td>
                            <td>
                              <!-- <img src="assets/images/faces/face1.jpg" alt="image" /> -->
                              <span class="pl-2"><?php echo $row1['name']; ?></span>
                            </td>
                            <td> <?php echo $row['co_id']; ?> </td>
                            <td> &#8377 <?php echo $row['total']; ?> </td>
                            <td> <?php echo $row['transdate'] ?> </td>
                            <td>
                              <?php

                                if ($row['approval'] == 5) {
                                  echo '<div class="badge badge-outline-primary">pending</div>';
                                }
                                else if ($row['approval'] == 1) {
                                  echo '<div class="badge badge-outline-success">Approved</div>';
                                }
                                else {
                                  echo '<div class="badge badge-outline-danger">Rejected</div>';
                                }
                              ?>
                            </td>
                          </tr>

                          <?php
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
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
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