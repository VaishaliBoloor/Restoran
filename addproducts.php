<?php
  include 'header.php';
?>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Products</h4>
                    <p class="card-description"> Food menu items </p>
                    <form class="forms-sample" action="php/addproducts.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputName1">Food Item Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName3">Food Category</label>
                        <select class="form-control" name="category" id="exampleInputName3">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Price</label>
                        <input type="text" class="form-control" name="price" id="exampleInputPassword4" placeholder="Price">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Discount</label>
                        <input type="text" class="form-control" name="discount" id="exampleSelectGender" placeholder="Discount in %">
                      </div>
                      <div class="form-group">
                        <label>Image upload</label>
                        <input type="file" name="img" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Item Description</label>
                        <textarea class="form-control" id="exampleTextarea1" name="description" rows="4"></textarea>
                      </div>
                      <button type="submit" name="add" class="btn btn-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-dark">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
    <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
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
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>