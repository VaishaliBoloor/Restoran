<?php
    // ob_start();

    $title = "Starbelly - Cart";
    $active5 = "active";
    require 'header.php';

    if (empty($_SESSION['u_id'])) {
        header('Location: signin.php');
    }
?>
<script>
    function changeRate(id,pos,pid) {
    var qu = document.getElementsByName("quantity")[pos].value;
    window.location.href="updatecart.php?id="+id+"&q="+qu+"&pi="+pid;
    }

    function contShop() {
        window.location.href="menu.php";
    }

    function checkOut(uid,totamt) {
        // var x = confirm("Are you sure you want to checkout?");
        window.location.href="payment.php?uid="+uid+"&tot="+totamt;
    }
</script>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Cart</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Cart</h5>
                    <h1 class="mb-5">Added Products</h1>
                </div>
            </div>
        </div>

        <div class="container-fluid text-center">
            <div class="row p-10 text-light">
                <table>
                    <tr class="bg-dark p-10 text-light">
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                    <?php

                        $u_id = $result['u_id'];
                        $i = 0;
                        $t = 0;
                        $c = 0;
                        $total = 0;

                        $sql = $conn->prepare("SELECT products.*, cart.* 
                        FROM cart
                        INNER JOIN products ON cart.p_id = products.p_id AND cart.u_id = '$u_id'");

                        $sql->execute();
                        while ($result1 = $sql->fetch(PDO::FETCH_ASSOC)) {
                        $p_id = $result1['p_id'];

                        $qty = $result1['qty'];
                        $price = $result1['price'];

                        $totprice = $qty * $price;

                        $t = $totprice + $t;
                        $total = $t + 30;
                        $c++;
                    ?>
                    <tr class=" p-10 text-dark border border-top-0 border-dark">
                        <td><img src="img/<?php echo $result1['image']; ?>" alt=""></td>
                        <td><input type="number" name="quantity" value="<?php echo $result1['qty']; ?>" id="<?php echo $u_id; ?>" onchange="changeRate(<?php echo $u_id;?>,<?php echo $i; ?>,<?php echo $p_id; ?>)" min="1" max="10"></td>
                        <td>&#8377 <?php echo $totprice; ?></td>
                        <td><a href="deletecart.php?id=<?php echo $result1['c_id']; ?>"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                    <?php
                        ++$i;
                        }
                    ?>
                </table>
            </div>
        </div>

        <div class="container pt-5">
            <h1><ins> Billing</ins></h1>
            <h4>Items: <?php echo $c; ?></h4>
            <h4>Delivery Charges: &#8377 30</h4>
            <h3>Total Price: &#8377 <?php echo $total; ?></h2>
            <button onClick="contShop()" type="button"  style="float:right;" class="btn btn-block btn-dark">Continue Shopping</button>
            <button onClick="checkOut(<?php echo $u_id ; ?>,<?php echo $total;?>)"  style="float:right; margin-right:20px" class="btn btn-lg btn-block btn-primary text-uppercase">Checkout</button>
        </div>


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top:100px !important;">
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