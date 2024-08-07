<?php
require 'koneksi.php';

session_start();

if (!isset($_SESSION['nama'])) {
    $namaUser = $_SESSION['email'];
}else{
    $namaUser = $_SESSION['nama'];
}

$sql = "SELECT * FROM user WHERE id = ?";
$res = $connection->prepare($sql);
$res->execute([$_SESSION['id']]);
$data = $res->fetch(PDO::FETCH_ASSOC);
if($data){
    $alamatUser = $data['alamat'];
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Vegetable Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">AnticFinder</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link ">Products</a>
                            <a href="index.php#footer" class="nav-item nav-link">Contacts</a>
                            <a href="cart.php" class="nav-item nav-link active">Cart</a>
                        </div>
                        <div class="d-flex m-3 me-0 align-items-center">
                            <div class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle rounded-bottom rounded-top border border-secondary href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small me-2"><?php echo $namaUser ?></span>
                                    <img class="img-profile rounded-circle" src="img/my-img/temp/undraw_profile.svg" style="height: 2rem; width: 2rem;">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="profile.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="logout.php" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->
        
        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">

            <hr>

        <!--ALAMAT-->
        <div class="d-flex justify-content-start align-items-center mb-0">
            <h5 class="mb-0" style="margin-right: 20rem;"><?php echo $namaUser ?></h5>
            <p class="mb-0"><?php echo $alamatUser ?></p>
        </div>
        <script src="main.js"></script>

        <hr>
            <div class="d-flex justify-content-center" style="gap: 3rem;">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($cart as $item){
                                    echo '<tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <img src="' . $item['gambar'] . '" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                                </div>
                                            </th>
                                            <td>
                                                <p class="mb-0 mt-4">' . $item['nama'] . '</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">Rp '. number_format($item['harga'], 2, ",", ".") .'</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">'. $item['quantity'] .'</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">Rp '. number_format($item['total'], 2, ",", ".") .'</p>
                                            </td>                                   
                                        </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!--METODE PEMBAYARAN-->
                <div class="card p-4 w-50" style="background-color: lightgray;">
                    <div class="d-flex flex-column justify-content-between mb-4">
                        <h5 class="mb-0 me-4">Metode Pembayaran :</h5>
                        <label class="radio-button">
                            <input type="radio" name="payment" value="cod" required>
                            <span>COD</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="payment" value="bank-transfer">
                            <span>Transfer Bank</span>
                        </label>
                    </div>
                    <div id="cod" class="hidden">
                        <p>COD: Cash on Delivery</p>
                    </div>
                    <div id="bank-list" class="hidden">
                        <p>Nomor Rekening:</p>
                        <h5 class="mb-3 me-4">BRI - 7876849754987</h5>
                        <form id="uploadForm">
                            <label for="fileInput">Pilih gambar untuk diunggah:</label>
                            <input type="file" id="fileInput" name="image" accept="image/*">
                            <div id="preview">
                                <p>Pratinjau Gambar:</p>
                                <img id="previewImage" src="#" alt="Pratinjau Gambar" style="display:none;">
                            </div>
                            <button type="submit">Unggah</button>
                        </form>
                    </div>
                </div>
            </div>
                
                <!-- <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
                </div> -->
            
                
                <script src="main.js"></script>
            </div> <!-- IKI NGGONE SOPO -->
            <div class="d-flex justify-content-center">
            <a href="checkout.html" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Checkout</a>
            </div>
        </div>
        <!-- Cart Page End -->


        <!-- Footer Start -->
        <div id="footer" class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <h1 class="text-primary mb-0">AnticFinder</h1>
                                <p class="text-secondary mb-0">Antic products</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative mx-auto">
                                <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                                <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-x-twitter"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5 justify-content-between">
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Informations    </h4>
                            <a class="btn-link" href="">Products</a>
                            <a class="btn-link" href="">Contacts</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Account</h4>
                            <a class="btn-link" href="">My Account</a>
                            <a class="btn-link" href="">Shop details</a>
                            <a class="btn-link" href="">Order History</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Address: 1429 Netus Rd, NY 48247</p>
                            <p>Email: Example@gmail.com</p>
                            <p>Phone: +0123 4567 8910</p>
                            <p>Payment Accepted</p>
                            <img src="img/payment.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

</html>