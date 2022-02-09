<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="TechyDevs"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="images/favicon.png"/>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
    <style>
        .help-block {
            color: #dd4b39;
        }

        .has-error {
            color: #dd4b39;
        }
        .fieldset {
            /* box-shadow: 3px 4px 5px #ccc; */
            border: 1px solid #ccc;
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="loader-container">
        <div class="loader-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <header class="header-area">
        <div class="main-menu-header py-3">
            <div class="container">
                <div class="main-menu-wrapper bg-transparent rounded-0 p-0">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <a href="{{ url('/') }}" class="main-logo">
                                <h5 class="text-white">{{ env('APP_NAME') }}</h5>
                                {{-- <img class="sticky-logo-hide" src="{{ asset('assets/images/logo-white.png') }}" alt="logo"> --}}
                                {{-- <img class="sticky-logo-show" src="{{ asset('assets/images/logo-black.png') }}" alt="logo"> --}}
                            </a>
                        </div>
                        {{-- <div class="col-lg-10">
                            <div class="main-navbar d-flex align-items-center justify-content-between">
                                <nav class="main-nav main-nav-white text-capitalize main-nav-2">
                                    <ul>
                                        <li>
                                            <a href="#">home <i class="fal fa-angle-down font-size-12"></i></a>
                                            <ul class="drop-menu">
                                                <li><a href="index.html">home one</a></li>
                                                <li><a href="index-2.html">home two</a></li>
                                                <li><a href="index-3.html">home three</a></li>
                                                <li><a href="index-4.html">home four <span class="badge badge-info ml-1">New</span></a></li>
                                            </ul>
                                        </li>
                                        <li class="has-mega-menu">
                                            <a href="#">pages <i class="fal fa-angle-down font-size-12"></i></a>
                                            <div class="drop-menu mega-menu">
                                                <ul class="row no-gutters">
                                                    <li class="mega-menu-item col-lg-4">
                                                        <ul>
                                                            <li><a href="about.html">about us</a></li>
                                                            <li><a href="service.html">services</a></li>
                                                            <li><a href="contact.html">contact</a></li>
                                                            <li><a href="contact-2.html">contact 2 <span class="badge badge-info ml-1">New</span></a></li>
                                                            <li><a href="cart.html">cart</a></li>
                                                            <li><a href="checkout.html">checkout</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-item col-lg-4">
                                                        <ul>
                                                            <li><a href="server-error-page.html">server error page</a></li>
                                                            <li><a href="faq.html">FAQs</a></li>
                                                            <li><a href="pricing.html">pricing</a></li>
                                                            <li><a href="chart.html">charts</a></li>
                                                            <li><a href="error-404.html">404 page</a></li>
                                                            <li><a href="error-two-404.html">404 page 2 <span class="badge badge-info ml-1">New</span></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-item col-lg-4">
                                                        <ul>
                                                            <li><a href="terms-of-services.html">terms of services</a></li>
                                                            <li><a href="sign-up.html">sign up</a></li>
                                                            <li><a href="login.html">login</a></li>
                                                            <li><a href="recover.html">recover password</a></li>
                                                            <li><a href="coming-soon.html">coming soon</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">team <i class="fal fa-angle-down font-size-12"></i></a>
                                            <ul class="drop-menu">
                                                <li><a href="team-member.html">team</a></li>
                                                <li><a href="team-single.html">team detail</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">blog <i class="fal fa-angle-down font-size-12"></i></a>
                                            <ul class="drop-menu">
                                                <li><a href="blog-grid-no-sidebar.html">grid no sidebar</a></li>
                                                <li><a href="blog-right-sidebar.html">right sidebar</a></li>
                                                <li><a href="blog-left-sidebar.html">left sidebar</a></li>
                                                <li><a href="blog-single.html">blog detail</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="navbar-toolbar d-flex align-items-center">
                                    <ul class="list-items list-items-white">
                                        <li class="d-inline-block mr-2"><a href="login.html">Sign in</a></li>
                                        <li class="d-inline-block"><a href="sign-up.html" class="btn btn-sm btn-light text-black">Get Started</a></li>
                                    </ul>
                                    <div class="hamburger hamburger-white">
                                        <span class="line"></span>
                                        <span class="line"></span>
                                        <span class="line"></span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section id="register-section" class="hero-area hero-area-3 bg-dark">
        <span class="ring-shape ring-shape-white ring-shape-1 position-absolute"></span>
        <span class="ring-shape ring-shape-white ring-shape-2 position-absolute"></span>
        <span class="ring-shape ring-shape-white ring-shape-3 position-absolute"></span>
        <span class="ring-shape ring-shape-white ring-shape-4 position-absolute"></span>
        <span class="ring-shape ring-shape-white ring-shape-5 position-absolute"></span>
        <span class="ring-shape ring-shape-white ring-shape-6 position-absolute"></span>
        <span class="ring-shape ring-shape-white ring-shape-7 position-absolute"></span>
        <span class="ring-shape ring-shape-white ring-shape-8 position-absolute"></span>
        <div class="container">
            <div class="hero-content">
                <h1 class="sec-title font-size-50 mb-3 text-white  text-center">Real time farm produce forecast</h1>
                <p class="sec-desc text-white  text-center">Easiest way to stay updated with the acurate market price of farm produce</p>
                @if (Session::has('error'))
                    <div class="col-lg-6 mx-auto mt-5">
                        <div class="alert alert-danger">
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="col-lg-6 mx-auto mt-5">
                        <div class="alert alert-success">
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                <div id="login-container">
                    <form class="padding-top-35px col-lg-6 mx-auto" method="POST" id="login-form" action="{{ route('login') }}" novalidate>
                        @csrf
                        <fieldset class="fieldset">
                            <legend>Login</legend>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form--control" placeholder="Enter your email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block mt-0 mr-50">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control form--control" placeholder="Enter your password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="help-block mt-0 mr-50">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm float-right">Login</button>
                            </div>
                            <br><br>
                            <a href="#register-container" id="register-link">Don't have an account, register Now!</a>
                        </fieldset>
                    </form>
                </div>

                <div id="register-container">
                    <form class="padding-top-35px col-lg-6 mx-auto" method="POST" id="register-form" action="{{ route('register') }}" novalidate>
                        @csrf
                        <fieldset class="fieldset">
                            <legend>Register</legend>
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Fullname</label>
                                <input type="text" name="name" id="name" class="form-control form--control" placeholder="Enter your fullname" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block mt-0 mr-50">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form--control" placeholder="Enter your email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block mt-0 mr-50">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" id="phone" required class="form-control form--control" placeholder="Enter your phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="help-block mt-0 mr-50">
                                        {{ $errors->first('phone') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="register-password" class="form-control form--control" placeholder="Enter your password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="help-block mt-0 mr-50">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control form--control" placeholder="Retype your password" value="{{ old('confirm_password') }}">
                                @if ($errors->has('confirm_password'))
                                    <span class="help-block mt-0 mr-50">
                                        {{ $errors->first('confirm_password') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm float-right">Register</button>
                            </div>

                            <br><br>
                            <a href="#login-container" id="login-link">Already registered, login now!</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <svg class="hero-svg hero--svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path d="M500,97C126.7,96.3,0.8,19.8,0,0v100l1000,0V1C1000,19.4,873.3,97.8,500,97z"></path>
        </svg>
    </section>
    {{-- <section class="marketprice-area padding-bottom-120px">
        <div class="container">
            <div class="card generic-table table-responsive generic-table-negative">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produce</th>
                        <th scope="col">Previous Price</th>
                        <th scope="col">Current Price</th>
                        <th scope="col">Unit</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalStockPrice =  0;
                        @endphp
                        @foreach ($stocks as $stock)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}.</th>
                                <td class="d-flex align-items-center crypto-name-wrap">
                                    <p class="line-height-18">
                                        {{ $stock->name }}
                                    </p>
                                </td>
                                <td><span class="numeral red">&#8358;{{ number_format($stock->previous_price, 2) }}</span></td>
                                <td><span class="numeral green">&#8358;{{ number_format($stock->current_price, 2) }}</span> </td>
                                <td>{{ $stock->unit }}</td>
                            </tr>
                            @php
                                $totalStockPrice += $stock->current_price;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-light">View More Markets <i class="fal fa-angle-down ml-1"></i></a>
            </div>
        </div>
    </section>
    <hr class="border-top-gray my-0">

    <hr class="border-top-gray my-0">
    <section class="feature-area section--padding">
        <div class="container">
            <div class="text-center">
                <h2 class="sec-title mb-3">The most trusted farm produce price platform</h2>
                <p class="sec-desc">We are here to support in the following way</p>
            </div>
            <div class="row mt-5">
                <div class="col-lg-4 col-md-6">
                    <div class="card hover-y">
                        <div class="card-body position-relative">
                            <div class="icon-element text-color fancy-radius">
                                <i class="fal fa-user-lock"></i>
                            </div>
                            <h4 class="card-title mt-4">Secure storage</h4>
                            <p class="card-desc mb-3">Agricultural Produce Safety</p>
                            <a href="#" class="btn-link">About secure farm produce prices <i class="fal fa-long-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card hover-y">
                        <div class="card-body position-relative">
                            <div class="icon-element text-color fancy-radius">
                                <i class="fal fa-piggy-bank"></i>
                            </div>
                            <h4 class="card-title mt-4">Protected by insurance</h4>
                            <p class="card-desc mb-3">Hight level of financial security.</p>
                            <a href="#" class="btn-link">Learn how secure farm investment <i class="fal fa-long-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card hover-y">
                        <div class="card-body position-relative">
                            <div class="icon-element text-color fancy-radius">
                                <i class="fal fa-user-check"></i>
                            </div>
                            <h4 class="card-title mt-4">Industry best practices</h4>
                            <p class="card-desc mb-3">Giving you first hand information prices.</p>
                            <a href="#" class="btn-link"><i class="fal fa-long-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="funfact-area bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="counter-item bg-slim-white py-5 mb-4 mb-lg-0">
                        <h2 class="counter-number text-white mb-2">&#8358; {{ number_format($totalStockPrice,2) }}+</h2>
                        <p class="counter-title text-white">Total Stocks Worth</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="counter-item bg-slim-white py-5 mb-4 mb-lg-0">
                        <h2 class="counter-number text-white mb-2">{{ count($stocks) }}+</h2>
                        <p class="counter-title text-white">Available Stocks</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="counter-item bg-slim-white py-5 mb-4 mb-lg-0">
                        <h2 class="counter-number text-white mb-2">200+</h2>
                        <p class="counter-title text-white">Verified Subscribers</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section class="cta-area section-padding text-center bg-gray">
        <div class="container">
            <h2 class="sec-title mb-3">Get Started Today With {{ env('APP_NAME') }}</h2>
            <p class="sec-desc mb-4">Join our subscribers list and stay updated</p>
            <a href="#register-section" class="btn btn-primary">Register Now <i class="fal fa-angle-right ml-1"></i></a>
        </div>
    </section> --}}

    <section class="footer-area padding-top-80px pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item mb-5">
                        <a href="/" class="d-block">
                            <h5>{{ env('APP_NAME') }}</h5>
                        </a>
                        <ul class="list-items pt-4">
                            <li class="mb-3"><a href="mailto:example@gmail.com"><i class="fal fa-envelope mr-1 font-size-14"></i> example@gmail.com</a></li>
                            <li class="mb-3"><a href="tel:0021621184010"><i class="fal fa-phone mr-1 font-size-14"></i> 00216 21 184 010</a></li>
                            <li class="mb-3"><i class="fal fa-map-marker-alt mr-1 font-size-14"></i> Ilorin, Kwara State</li>

                        </ul>
                        <div class="social-icons">
                            <a href="#" class="icon-element icon-element-sm mr-1"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="icon-element icon-element-sm mr-1"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="icon-element icon-element-sm mr-1"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="icon-element icon-element-sm mr-1"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item mb-5">
                        <h5 class="mb-3 font-weight-semi-bold">Product Forecast</h5>
                        <div class="title-shape border-bottom-0"><span></span></div>
                        </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item mb-5">
                        <h5 class="mb-3 font-weight-semi-bold">Help & Support</h5>
                        <div class="title-shape border-bottom-0"><span></span></div>
                    </div><!-- end footer-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item mb-5">
                        <h5 class="mb-3 font-weight-semi-bold">Subscribe to Newsletter</h5>
                        <div class="title-shape border-bottom-0"><span></span></div>
                        <p class="pt-4">Get farm produce analysis, news and updates right to your inbox!</p>
                        <form action="#" class="pt-3">
                            <input type="text" class="form-control form--control mb-3" placeholder="Enter email address">
                            <button class="btn btn-primary w-100" type="submit">Subscribe Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-top-gray my-4">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <p class="copy-desc">Copyright &copy; {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved.</p>
            </div>
        </div>
    </section>
    <div id="scroll-to-top">
        <i class="far fa-angle-up" title="Go top"></i>
    </div>
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
    <script>
        // window.setInterval(() => {
        //     window.location.reload();
        // }, 60000);

        $(document).ready(function () {
            document.querySelector('#register-container').style.display = 'none';
        });

        $('#login-link').on('click', () => {
            $('#login-container').fadeIn();
            $('#register-container').hide(300);
        });

        $('#register-link').on('click', () => {
            $('#register-container').fadeIn();
            $('#login-container').hide(300);
        });

        $('#register-form').validate({
            rules: {
                name: { required: true },
                email: { required: true, email:  true },
                phone: { required: true, minlength: 11, maxlength: 11 },
                password: { required: true },
                confirm_password: { required: true, equalTo: '#register-password' }
            },
            messages: {
                name: { required: 'The Name field is required.' },
                email: { required: 'The Email field is required.' },
                phone: { required: 'The Phone field is required.' },
                password: { required: 'The Password field is required.' },
                confirm_password: { 
                    required: 'The Confirm Password field is required.',
                    equalTo: 'Passwords does not match'
                }
            },
            onfocus: true,
            onblur: true,
            errorElement: 'strong',
            errorClass: 'help-block',
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                    return false;
                } else {
                    error.insertAfter(element);
                    return false;
                }
            }
        });

        $('#login-form').validate({
            rules: {
                email: { required: true, email: true },
                password: { required: true }
            },
            messages: {
                email: { required: 'The Email field is required.' },
                password: { required: 'The Password field is required.' }
            },
            onfocus: true,
            onblur: true,
            errorElement: 'strong',
            errorClass: 'help-block',
            highlight: function (element) { 
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                    return false;
                } else {
                    error.insertAfter(element);
                    return false;
                }
            }
        });
    </script>
</body>
</html>
