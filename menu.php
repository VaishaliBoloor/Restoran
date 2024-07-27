<?php
    $title = "Restoran - Menu";
    $active4 = "active";
    require 'header.php';

    if (empty($_SESSION['u_id'])) {
        // ob_start();
        header('Location: signin.php');
    }

    ?>
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Food Menu</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
                            <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Menu Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                    <h1 class="mb-5">Most Popular Items</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <form action="#">
                        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                            <li class="nav-item">
                                <button type="submit" name="break" style="border:none; background-color: transparent;">
                                <!-- <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 <?php echo "active"; ?>" data-bs-toggle="pill"> -->
                                    <i class="fa fa-coffee fa-2x text-primary"></i>
                                    <div class="ps-3">
                                        <small class="text-body">Popular</small>
                                        <h6 class="mt-n1 mb-0">Breakfast</h6>
                                    </div>
                                <!-- </a> --> 
                            </button>
                            </li>
                            <li class="nav-item">
                            <button type="submit" name="lun" style="border:none; background-color: transparent;">
                                <!-- <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" > -->
                                    <i class="fa fa-hamburger fa-2x text-primary"></i>
                                    <div class="ps-3">
                                        <small class="text-body">Special</small>
                                        <h6 class="mt-n1 mb-0">Lunch</h6>
                                    </div>
                                <!-- </a> -->
                            </button>
                            </li>
                            <li class="nav-item">
                            <button type="submit" name="din" style="border:none; background-color: transparent;">
                                <!-- <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" > -->
                                    <i class="fa fa-utensils fa-2x text-primary"></i>
                                    <div class="ps-3">
                                        <small class="text-body">Lovely</small>
                                        <h6 class="mt-n1 mb-0">Dinner</h6>
                                    </div>
                                <!-- </a> -->
                                </button>
                            </li>
                        </ul>
                    </form>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                            </div>
                        </div>
                    </div>
                            <?php 
                            
                            $u_id = $result['u_id'];

                            if (isset($_POST['submit'])) {
                                $p_id = $_POST['prode'];
                                $sql2 = $conn->prepare("SELECT * FROM cart WHERE u_id = '$u_id' AND p_id = '$p_id'"); 
                                $sql2->execute();
                                $row = $sql2->fetch(PDO::FETCH_ASSOC);
                                if ($row > 1) {

                                }
                                else {
                                $sql1 = $conn->prepare("INSERT INTO cart (p_id, u_id, qty) VALUES ('$p_id', '$u_id', '1')");
                                $sql1->execute();
                                if ($sql1) {
                                    echo "<script>alert 'added to cart'; </script>";
                                }
                            }
                            }
                            if (isset($_GET['break'])) {
                                $stmt1 = $conn->prepare("SELECT * FROM products WHERE category='breakfast' LIMIT 16");
                                $stmt1->execute();
                                $prod1 = $stmt1->rowCount();
                                if ($prod1 == 0) {
                                    echo "No products available";
                                }
                                else {
                                while ($result1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <div class="col-lg-6">
                                    <a name="submit" href="cart.php?pid=<?php echo $result1['p_id']; ?>">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/<?php echo $result1['image']; ?>" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span><?php echo $result1['name']; ?></span>
                                                <span class="text-primary">&#8377 <?php echo $result1['price']; ?></span>
                                            </h5>
                                            <small class="fst-italic"><?php echo $result1['discription']; ?></small>
                                            <form action="#" method="post">
                                            <input type="hidden" name="prode" value = "<?php echo $result1['p_id']; ?>">
                                            <input type="submit" name="submit" class="btn-primary" value="Add to Cart">
                                            </form>
                                        </div>
                                    </div>
                                </a>
                                
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <!-- <div id="tab-2" class="tab-pane fade show p-0"> -->
                            <!-- <div class="row g-4"> -->
                                <?php 
                                    if (isset($_GET['lun'])) {
                                        $stmt2 = $conn->prepare("SELECT * FROM products WHERE category='lunch' LIMIT 16");
                                        $stmt2->execute();
                                        $prod2 = $stmt2->rowCount();
                                        if ($prod2 == 0) {
                                            echo "No products available";
                                        }
                                        else {
                                        while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <div class="col-lg-6">
                                    <a href="cart.php?pid=<?php echo $result2['p_id']; ?>">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/<?php echo $result2['image']; ?>" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span><?php echo $result2['name']; ?></span>
                                                <span class="text-primary">&#8377 <?php echo $result2['price']; ?></span>
                                            </h5>
                                            <small class="fst-italic"><?php echo $result2['discription']; ?></small>
                                            <form action="#" method="post">
                                            <input type="hidden" name="prode" value = "<?php echo $result2['p_id']; ?>">
                                            <input type="submit" name="submit" class="btn-primary" value="Add to Cart">
                                            </form>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                    }
                                }
                            }
                            ?>
                        <!-- </div> -->
                        <!-- <div id="tab-1" class="tab-pane fade show p-0"> -->
                            <!-- <div class="row g-4"> -->
                            <?php 
                                if (isset($_GET['din'])) {
                                    $stmt3 = $conn->prepare("SELECT * FROM products WHERE category='dinner' LIMIT 16");
                                    $stmt3->execute();
                                    $prod3 = $stmt3->rowCount();
                                    if ($prod3 == 0) {
                                        echo "No products available";
                                    }
                                    else {
                                    while ($result3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <div class="col-lg-6">
                                    <a href="cart.php?pid=<?php echo $result3['p_id']; ?>">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="img/<?php echo $result3['image']; ?>" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span><?php echo $result3['name']; ?></span>
                                                <span class="text-primary">&#8377 <?php echo $result3['price']; ?></span>
                                            </h5>
                                            <small class="fst-italic"><?php echo $result3['discription']; ?></small>
                                            <form action="#" method="post">
                                            <input type="hidden" name="prode" value = "<?php echo $result3['p_id']; ?>">
                                            <input type="submit" name="submit" class="btn-primary" value="Add to Cart">
                                            </form>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                }
                            }
                        }
                            ?>
                                <!-- </div> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Reservation</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@Starbelly.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Saturday</h5>
                        <p>09AM - 12PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 12PM</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a><br><br>
                            Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
<?php
// ob_clean();
 
?>