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
</div>
<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <li><a href="{{route('about-us')}}">About Us</a></li>
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
                <div class="col-md-2 d_none">
                    <ul class="con_icon">
                        <li><a href="javascript:void(0)"><i class="fa fa-phone" aria-hidden="true"></i>+91 7025723884</a></li>
                    </ul>
                </div>

                <div class="col-md-10 d_none">
                    <ul class="login_deteil text_align_right">
                        <li><a href="{{route('about-us')}}">About Us</a></li>
                        <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a href="{{url('/terms-and-conditions')}}">Terms and Conditions</a></li>
                        <li><a href="{{route('products-web')}}">Products</a></li>
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
                        <a href="/">Aucto<span>pets</span></a>
                    </div>
                </div>
                <div class="col-sm-9">
                    <ul class="email text_align_right">
                        <li> <button class="openbtn" onclick="openNav()"><img src="{{asset('assets/website/images/menu_btn.png')}}"></button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<!-- start slider section -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class=" banner_main">
                    <div class="bluid">
                        <h1>Care of Your pet </h1>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end slider section -->
<!-- services -->
<div class="services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>Services we offer</h2>
                    <p>Auctopets offers variety of Services</p>
                    <a href="{{route('products-web')}}">More</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="service_text">
                    <i><img src="{{asset('assets/website/images/service_icon1.png')}}" alt="#"/></i>
                    <h3>PET FOODS</h3>
                    <p>One of the best Pet foods u can ever get , Auctopets assure you best pets in Market</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service_text">
                    <i><img src="{{asset('assets/website/images/service_icon2.png')}}" alt="#"/></i>
                    <h3>VACCINATION</h3>
                    <p>Vaccination plays a crucial role in maintaining the health and well-being of your beloved pets.
                        So we Auctopets provides Healthy Well vaccinated Pet </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service_text">
                    <i><img src="{{asset('assets/website/images/service_icon3.png')}}" alt="#"/></i>
                    <h3>PET GRO0MING</h3>
                    <p>Best pet grooming products</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end services -->
<!-- pet -->
<div class="pet">
    <div class="container">
        <div class="row d_flex">
            <div class="col-md-6">
                <div class="titlepage text_align_left">
                    <span>Looking For a pet</span>
                    <h2>Find for Your <br>Best Pet With Auctopets</h2>
                    <a href="#contact" class="read_more">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="choose">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>How to Get Started</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div id="ho_id" class="teab_box">
                    <span>01</span>
                    <h3>Sign Up</h3>
                    <p>Create a free account to start exploring pets available for bidding.
                    </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div id="ho_id" class="teab_box">
                    <span>02</span>
                    <h3>Complete Your Profile</h3>
                    <p>Provide information about your preferences and home environment to get personalized pet
                        recommendations.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div id="ho_id" class="teab_box">
                    <span>03</span>
                    <h3>Start Buying Products</h3>
                    <p>Browse pets foods, place order, and track your favorite order.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div id="ho_id" class="teab_box">
                    <span>04</span>
                    <h3>Delivered</h3>
                    <p>You have Purchased the product!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="titlepage text_align_center">
                    <h2>Get In Touch</h2>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <form id="request" class="main_form">
                    <div class="row">
                        <div class="col-md-12 ">
                            <input class="contactus" placeholder="Name" type="type" name=" Name">
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Phone number" type="type" name="Phone Number">
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Email Address" type="type" name="Email">
                        </div>
                        <div class="col-md-12">
                            <textarea class="textarea" placeholder="Message" type="type" Message="Name"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="send_btn">Send</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                <div class="map_resposive">
                    <figure><img src="{{asset('assets/website/images/map.png')}}" alt="#"/></figure>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contact -->
<!-- footer -->
<footer id="contact">
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
                                    <li><a href="Javascript:void(0)"> <i><img
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
                            <li><a class="mr-2" href="{{route('products-web')}}">Products</a></li>
                            <li><a class="mr-2" href="{{route('about-us')}}">About Us</a></li>
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
