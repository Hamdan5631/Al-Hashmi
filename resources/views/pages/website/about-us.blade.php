<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Auctopets</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/new-logo.png')}}">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('assets/website/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('assets/website/css/style.css')}}">
    <!-- responsive-->
    <link rel="stylesheet" href="{{asset('assets/website/css/responsive.css')}}">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->
<body class="main-layout">
<!-- loader  -->
<div class="loader_bg" style="background: #8EDCFF">
    <div class="loader"><img src="{{asset('assets/images/aucto-new-logo.png')}}" style="object-fit: contain" alt=""/></div>
</div>>
<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <li><a href="{{route('contact-us')}}">Contact Us</a></li>
    <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
    <li><a href="{{url('/terms-and-conditions')}}">Terms and Conditions</a></li>
    <li><a href="{{route('refund-policy')}}">Refund And Cancellation Policy</a></li>
    <li><a href="{{route('shipping-delivery-policy')}}">Shipping and Delivery Policy</a></li>
</div>
<header>

    <div class="head_top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d_none">
                    <ul class="con_icon">
                        <li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i>+91
                                7025723884</a></li>
                    </ul>
                </div>

                <div class="col-md-8 d_none">
                    <ul class="login_deteil text_align_right">
                        <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a href="{{url('/terms-and-conditions')}}">Terms and Conditions</a></li>
                        <li><a href="{{route('refund-policy')}}">Refund And Cancellation Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="head-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="logo">
                        <a href="/">Aucto<span class="text-white">pets</span></a>
                    </div>
                </div>
                <div class="col-sm-9">
                    <ul class="email text_align_right">
                        <li>
                            <button class="openbtn" onclick="openNav()"><img
                                    src="{{asset('assets/website/images/menu_btn.png')}}"></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="pet about mt-0">
    <div class="container">
        <div class="row d_flex">
            <div class="col-md-6">
                <div class="titlepage text_align_left">
                    <h2>About Us</h2>
                    <p class="text-white">
                        Welcome to AuctoPets, where the health and happiness of your pets are our top
                        priority! As passionate pet lovers, we understand that your furry friends are more than just
                        pets—they're family. That's why we are dedicated to providing the highest quality pet foods and
                        essentials to keep your companions thriving.

                        Our journey began with a simple mission: to offer wholesome, nutritious, and delicious food that
                        pets love and that pet parents can trust. We carefully source our products from reputable brands
                        known for their commitment to quality and safety, ensuring that every meal you serve your pet is
                        packed with the nutrients they need to live a long, healthy, and active life.

                        At AuctoPets, we believe that feeding your pet should be as enjoyable as playing with
                        them. Whether you have a playful pup, a curious cat, or any other beloved animal, we have
                        something for every diet and taste.

                        Join us in our mission to keep pets happy and healthy. Explore our range of products, and give
                        your pets the love they deserve through the food they eat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<footer id="contact" class="mt-3">
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="Informa">
                        <h3>About</h3>
                        <ul class="conta">
                            <li><a href="Javascript:void(0)"><i><img src="{{asset('assets/website/images/loc.png')}}"
                                                                     alt="#"/></i>
                                </a>
                                Thavakkal Complex
                                <br>Kolathur 679338
                                <br> Kerala ,India<br>
                            </li>
                            <li><a href="Javascript:void(0)"> <i><img src="{{asset('assets/website/images/mail.png')}}"
                                                                      alt="#"/></i> auctopets@gmail.com
                                    <li><a href="Javascript:void(0)"> <i>
                                                <img
                                                    src="{{asset('assets/website/images/call.png')}}" alt="#"/></i>
                                            +91 7025723884
                                        </a></li>
                        </ul>
                        <ul class="social_icon text_align_center">
                            <li><a href="Javascript:void(0)"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="Javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="Javascript:void(0)"><i class="fa fa-linkedin-square"
                                                                aria-hidden="true"></i></a></li>
                            <li><a href="Javascript:void(0)"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="Informa">
                                <h3>Newsletter</h3>
                                <form class="newslatter_form">
                                    <input class="ente" placeholder=" Your Email" type="text" name="Enter your email">
                                    <button class="subs_btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright text_align_center">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p>© 2024 Auctopets All Rights Reserved.</p>
                    </div>
                    <div>
                        <ul class="d-flex">
                            <li><a class="mr-2" href="{{url('/terms-and-conditions')}}">Terms of Service</a></li>
                            <li><a class="mr-2" href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                            <li><a class="mr-2" href="{{route('refund-policy')}}">Refund Policy</a></li>
                            <li><a class="mr-2" href="{{route('shipping-delivery-policy')}}">Shipping Delivery Policy</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<!-- Javascript files-->
<script src="{{asset('assets/website/js/jquery.min.js ')}}"></script>
<script src="{{asset('assets/website/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/website/js/jquery-3.0.0.min.js ')}}"></script>
<script src="{{asset('assets/website/js/custom.js ')}}"></script>
</body>
</html>
