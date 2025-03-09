<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Auctopets</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('assets/website/css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('assets/website/css/style.css')}}">
    <!-- responsive-->
    <link rel="stylesheet" href="{{asset('assets/website/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/contac.scss')}}">
    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style>
        .card {
            background-color: #215070;
            display: table;
            width: 100%;
            height: 132px;
            color: #3498db;
            overflow: hidden;
            margin-bottom: 30px;
            border-radius: 3px;

            .icon {
                width: 48px;
                height: 100%;
                display: table-cell;
                position: relative;

                &:after {
                    content: '';
                    height: 100%;
                    width: 0;
                    position: absolute;
                    right: -90px;
                    top: 0;
                    border-right: 90px solid transparent;
                    border-left: 0px;
                    border-bottom: 272px solid currentColor;
                }

                background-color: currentColor;

                i {
                    position: absolute;
                    bottom: 25px;
                    left: 25px;
                    color: #fff;
                    font-size: 28px;
                    z-index: 1;
                }
            }

            .content-wrap {
                padding: 10px;
                padding-left: 62px;
                display: table-cell;
                vertical-align: middle;

                .item-title {
                    display: inline-block;
                    font-size: 16px;
                    color: #a3baca;
                    margin-bottom: 3px;
                }

                .text {
                    color: #fff;
                    font-size: 15px;
                }
            }
        }
    </style>

</head>
<!-- body -->
<body class="main-layout inner_page">
<!-- loader  -->
<div class="loader_bg" style="background: #8EDCFF">
    <div class="loader"><img src="{{asset('assets/images/aucto-logo.png')}}" style="object-fit: contain" alt=""/></div>
</div>
<div id="mySidepanel" class="sidepanel">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <li><a href="{{route('about-us')}}">About Us</a></li>
    <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
    <li><a href="{{url('/terms-and-conditions')}}">Terms and Conditions</a></li>
    <li><a href="{{route('refund-policy')}}">Refund And Cancellation Policy</a></li>
    <li><a href="{{route('shipping-delivery-policy')}}">Shipping and Delivery Policy</a></li>

</div>
<header>
    <!-- header inner -->
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
                        <a href="/">Aucto<span>Pets</span></a>
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
<!-- end header -->
<!-- contact -->
<div class="contact-cards container mb-3" style="margin-top: 220px">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
        <span class="icon">
          <i class="fa fa-phone"></i>
        </span>
                <div class="content-wrap">
          <span class="item-title">
            Call us anytime
          </span>
                    <p class="text">
                        +91 7025723884
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
        <span class="icon">
          <i class="fa fa-map-o"></i>
        </span>
                <div class="content-wrap">
          <span class="item-title">
            Our Address
          </span>
                    <p class="text">
                        Thavakkal Complex
                        Kolathur 679338
                        Kerala ,India
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
        <span class="icon">
          <i class="fa fa-envelope-o"></i>
        </span>
                <div class="content-wrap">
          <span class="item-title">
            Mail us at
          </span>
                    <p class="text">
                        auctopets@gmail.com
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

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
                    <ul class="d-flex">
                        <li><a class="mr-2" href="{{url('/terms-and-conditions')}}">Terms of Service</a></li>
                        <li><a class="mr-2" href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li><a class="mr-2" href="{{route('products-web')}}">Products</a></li>
                        <li><a class="mr-2" href="{{route('refund-policy')}}">Refund Policy</a></li>
                        <li><a class="mr-2" href="{{route('shipping-delivery-policy')}}">Shipping Delivery Policy</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('assets/website/js/jquery.min.js ')}}"></script>
<script src="{{asset('assets/website/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/website/js/jquery-3.0.0.min.js ')}}"></script>
<script src="{{asset('assets/website/js/custom.js ')}}"></script>
</body>
</html>
