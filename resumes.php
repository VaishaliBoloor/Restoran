<?php
  ob_start();
  require 'header.php';

          $sql = $conn->prepare("SELECT * FROM carrier");
          $sql->execute(); 

        ?>

        <script>
            function download(cid) {
                window.location.href = 'download.php?cid='+cid
            }
        </script>

      <div class="main-panel">
        <div class="content-wrapper">
    <div class="col-15">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> Carrier Resumes</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th> Id</th>
                    <th> Applicant Name </th>
                    <th> Email </th>
                    <!-- <th> Payment </th> -->
                    <th>  Resume </th>
                    <!-- <th> Payment Mode </th> -->
                    <!-- <th> Date & Time </th> -->
                    <th> Download </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <tr>
                  <td> <?php echo  $result['c_id'];?> </td>
                    <td>
                      <!-- <img src="assets/images/faces/face1.jpg" alt="image" /> -->
                      <span class="pl-2"><?php echo $result['name']; ?></span>
                    </td>
                    <!-- <td> 02312 </td> -->
                    <!-- <td> &#8377 14,500 </td> -->
                    <td> <?php echo  $result['email'];?> </td>
                    <td> <?php echo  $result['resume'];?> </td>
                    <!-- <td> Credit card </td> -->
                    <td> <button name="approve" class="badge badge-outline-success" onclick="download(<?php echo  $result['c_id'];?>)" style="background-color:transparent;">Download</button></td>
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
<?php
ob_end_flush();
?>