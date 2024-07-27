

        <?php

        include 'header.php';
            $date = date("m/d/20y");
            
            $sql = $conn->prepare("SELECT reserve.*, user.name 
            FROM reserve
            INNER JOIN user ON reserve.u_id = user.u_id AND approval = 1 AND reservetime LIKE '$date%'");
            $sql->execute(); 

        ?>

      <div class="main-panel">
        <div class="content-wrapper">
    <div class="col-15">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Table Reservation For Today</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th> Customer Name </th>
                    <!-- <th> Order No </th> -->
                    <!-- <th> Payment </th> -->
                    <th> Members </th>
                    <!-- <th> Payment Mode </th> -->
                    <th> Date & Time </th>
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
                    <td> <?php echo $result['reservetime'];?></td>
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