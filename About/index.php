<?php
include('../db.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Platform Productions | Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/10df66229e.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-lg-5">
            <a href="/Platform/About/" class="navbar-brand ml-lg-3">
                <img src="../images/images/logo.jpg" height="60px">
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <a href="#about" class="nav-item nav-link">About Us</a>
                    <a href="#services" class="nav-item nav-link">Our Services</a>
                    <a href="#whychooseus" class="nav-item nav-link">Why Choose Us</a>
                    <a href="#testimonials" class="nav-item nav-link">Testimonials</a>
                    <a href="#contact" class="nav-item nav-link">Contact Us</a>
                    <div class="nav-item dropdown">
                        <a href="#login" class="nav-link dropdown-toggle" data-toggle="dropdown">Login</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="/Platform" class="dropdown-item">User Login</a>
                            <a href="/Platform/Vendor/" class="dropdown-item">Vendor Login</a>
                            <a href="/Platform/Admin/" class="dropdown-item">Admin Login</a>
                        </div>
                    </div>
                </div>
                <a href="/Platform/Login/register.php" class="btn btn-primary py-2 px-4 d-none d-lg-block">Register Now</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid mb-5">
        <div class="container text-center py-5">
            <h1 class="text-primary mb-4">We Take Your</h1>
            <h1 class="text-white display-3 mb-5">Dreams to Reality</h1>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div id="about" class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <img class="img-fluid w-100" src="../images/images/img.jpg" alt="">
                    <div class="bg-primary text-dark text-center p-4">
                        <h3 class="m-0">Since 2005</h3>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h6 class="text-primary text-uppercase font-weight-bold">About Us</h6>
                    <h1 class="mb-4">We Take Your Vision and Bring it to Reality</h1>
                    <p class="mb-4">‘Platform Productions’ is an Event Management company with its corporate office in Mangalore. We are having a wide network across borders with associate partners in Bangalore, Mumbai, Goa, Dubai and Thailand.
                        <br>
                        A Complete Event Management Company, with a young, energetic and talented team, works together on a platform to execute the given job with perfection. We are expertise in wedding planning, stage setting, conferences,corporate seminar, product launch, theme parties and many more.
                        </p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Services Start -->
    <div id="services" class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold"></h6>
                <h1 class="mb-4">Our Services</h1>
            </div>
            <div class="row pb-3">
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-burger text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Catering</h6>
                    </div>
                    <p>Our destination is good food, Platform Productions provides you the best catering services.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-tree text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Decor</h6>
                    </div>
                    <p>Beautiful and affordable decorations are waiting for you, just one click away. An unforgettable day done your way is easy with a huge selection of the most stylish in decor.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-camera text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Photography</h6>
                    </div>
                    <p>Spend your events with us, we will keep for you the best moments! Wedding photo/videography from Platform Productions.</p>
                </div>
            </div>
            <div class="row pb-3">
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-microphone text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">MC</h6>
                    </div>
                    <p>A great Opening Line should aim to accomplish two things. Grab the attention of the audience and create interest of what is going to happen next. Platform production provides you the best onstage emcee</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-music text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">DJ</h6>
                    </div>
                    <p>A great event has so many facets. Create the right atmosphere with the best music services from Platform Productions.</p>
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary mb-4 p-4">
                        <i class="fa fa-2x fa-user text-dark pr-3"></i>
                        <h6 class="text-white font-weight-medium m-0">Event Hosts</h6>
                    </div>
                    <p>Making sure that all guests are comfortable and have what they need.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- Features Start -->
    <div id="whychooseus" class="container-fluid bg-secondary my-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid w-100" src="../images/images/why.jpg" alt="">
                </div>
                <div class="col-lg-7 py-5 py-lg-0">
                    <!-- <h6 class="text-primary text-uppercase font-weight-bold">Why Choose Us</h6> -->
                    <h1 class="mb-4">Why Choose Us</h1>
                    <p class="mb-4">Platform Productions’ provides strategic planning and implementation of projects from concept to conclusion. We believe in our fresh approach to achieve higher standards of excellence in customer needs.</p>

                        <p>We have an experience of successfully organizing all type of events B2B, B2C, weddings, Theme parties,live concerts, Artist Managment, our capacity of organizing events starts from candle light dinner to sky is the limit, you name it we do it. </p>
                        
                        <p>NEWNESS & INNOVATION every- time is the uniqueness of Platform Productions. We use the latest equipments and always have alternative plan for situational risks. This made us to stand “different” in the mind of our customers.
                        </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->



    <!-- Testimonial Start -->
    <div id="testimonials" class="container-fluid py-5">
        <div class="container">
            <div class="text-center pb-2">
                <h6 class="text-primary text-uppercase font-weight-bold">Testimonial</h6>
                <h1 class="mb-4">Our Clients Say</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <?php
                $getBookings = "SELECT * FROM `user_login`,feedback WHERE user_login.User_ID=feedback.User_ID";
                $stmt = $con->prepare("$getBookings");
                $stmt->execute();
                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($stmt->rowCount()>0)
                {
                    //print_r($services);
                    foreach ($services as $row) {
                    ?>
                       <div class="position-relative bg-secondary p-4">
                    <i class="fa fa-3x fa-quote-right text-primary position-absolute" style="top: -6px; right: 0;"></i>
                    <div class="d-flex align-items-center mb-3">
                        <div class="ml-3">
                            <h6 class="font-weight-semi-bold m-0"><?php echo $row["Name"]; ?></h6>
                        </div>
                    </div>
                    <p class="m-0"><?php echo $row["Feedback"]; ?></p>
                </div>
                    <?php
                    }
                }
                else
                {
                    ?>
                    <h3>No Feedbacks!</h3>
                    <?php
                }
                    ?>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->



    <!-- Footer Start -->
    <div id="contact" class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-8 col-md-6">
                <div class="row ">
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Get In Touch</h3>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Pinto's Lane, Near PIO Mall, Bejai, Mangalore</p>
                        <p><i class="fa fa-phone-alt mr-2"></i><a href="tel:9880104399">+91 98801 04399</a> , <a href="tel:9742001818">+91 9742001818</a></p>
                        <p><i class="fa fa-envelope mr-2"></i><a href="mailto:platformindia@yahoo.in">platformindia@yahoo.in</a></p>
                            <div class="d-flex justify-content-start mt-4">
                                <a class="btn btn-outline-light btn-social mr-2" href="https://www.facebook.com/platformproductionsmangalore/"><i class="fab fa-facebook-f"></i></a>
                                <p>Follow Us</p>
                            </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Quick Links</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-white mb-2" href="#about"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                            <a class="text-white mb-2" href="#services"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                            <a class="text-white mb-2" href="#whychooseus"><i class="fa fa-angle-right mr-2"></i>Why Choose Us</a>
                            <a class="text-white" href="#testimonials"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="row text-justify">
                    <div class="col-md-6 mb-5">
                        <h3 class="text-primary mb-4">Login</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="/Platform/Login/register.php"><i class="fa fa-angle-right mr-2"></i>Register</a>
                            <a class="text-white mb-2" href="/Platform/Login/"><i class="fa fa-angle-right mr-2"></i>Sign In</a>
                            <a class="text-white mb-2" href="/Platform/Admin/"><i class="fa fa-angle-right mr-2"></i>Admin Login</a>
                            <a class="text-white mb-2" href="/Platform/Vendor/"><i class="fa fa-angle-right mr-2"></i>Vendor Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">Platform Productions</a> | All Rights Reserved
				
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>