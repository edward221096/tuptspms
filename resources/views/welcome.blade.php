<!DOCTYPE html>
<html lang="en">
<head>

    <title>Welcome to TUP Taguig SPMS</title>
    <!--

    DIGITAL TREND

    https://templatemo.com/tm-538-digital-trend

    -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('welcomepagecss/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('welcomepagecss/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('welcomepagecss/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('welcomepagecss/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('welcomepagecss/owl.theme.default.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('welcomepagecss/templatemo-digital-trend.css') }}">


</head>

<style>
</style>

<body>

<!-- MENU BAR -->
<nav class="navbar navbar-expand-lg" style="background-color: white;">
    <div class="container">
        @auth
        <a style="color: #404040;" class="navbar-brand" href="{{ url('/myevaluationforms') }}">
            <i><img src="images\tuptlogo.png" width="75px" height="75px"></i>
            TUP TAGUIG - SPMS
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @else
                    <a style="color: #404040;" class="navbar-brand" href="{{ url('/') }}">
                        <i><img src="images\tuptlogo.png" width="75px" height="75px"></i>
                        TUP TAGUIG - SPMS
                    </a>
                    <div class="nav-item">
                        <a style="font-size: 12pt; color: #404040;" href="{{ route('login') }}" class="nav-link smoothScroll">Login</a>
                    </div>
                    @if (Route::has('register'))
                        <div class="nav-item">
                            <a style="font-size: 12pt; color: #404040;" href="{{ route('register') }}" class="nav-link smoothScroll">Register</a>
                        </div>
                    @endif
                @endauth
                    <div class="nav-item">
                        <a style="font-size: 12pt; color: #404040;" href="{{url('/#about')}}" class="nav-link">About</a>
                    </div>
                    <div class="nav-item">
                        <a style="font-size: 12pt; color: #404040;" href="{{url('/#footer')}}" class="nav-link">Development Team</a>
                    </div>
            </ul>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>


<!-- HERO -->
<section class="hero hero-bg d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-10 col-12 d-flex flex-column justify-content-center align-items-center">
                <div class="hero-text">

                    <h2 class="text-white" data-aos="fade-up">Manage Individual Performance Commitment and Review (IPCR)</h2>
                    <h2 class="text-white" data-aos="fade-up">Office Performance Commitment Review (OPCR) Forms</h2>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="hero-image" data-aos="fade-up" data-aos-delay="300">

                    <img src="{{asset('welcomepageimages/form.png')}}" width="500px" height="500px" class="img-fluid" alt="working girl">
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ABOUT -->
<section class="about section-padding pb-0" id="about">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 mx-auto col-md-10 col-12">
                <div class="about-info">

                    <h2 class="mb-4" data-aos="fade-up">The easy way to access your <strong>IPCR and OPCR Form</strong></h2>
                    <p class="mb-0" data-aos="fade-up" style="font-style: italic;">Manage IPCR and OPCR forms view</p>

                </div>
                <div class="about-image" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{asset('welcomepageimages/ipcrforms.png')}}" width="1100px" height="" class="img-fluid" alt="office">
                </div>
                <div>
                <p class="mb-0" data-aos="fade-up" style="font-style: italic;">IPCR Total Count</p>

                </div>
                <div class="about-image" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{asset('welcomepageimages/ipcrtotalcount.png')}}" width="1100px" height="" class="img-fluid" alt="office">
                </div>
            </div>
            <div><br></div>
            <div class="col-lg-7 mx-auto col-md-10 col-12">
                <div><br>
                <p class="mb-0" data-aos="fade-up" data-aos-delay="200" style="font-style: italic;">Track Total Weighted Score of IPCR and OPCR Forms view</p>
                </div>
                <p class="mb-0" data-aos="fade-up"></p>
                <div class="about-image" data-aos="fade-up" data-aos-delay="200">

                    <img src="{{asset('welcomepageimages/mydashboard.png')}}" width="1100px" class="img-fluid" alt="mydashboard">
                </div>
            </div>
        </div>
    </div>
</section>

<br>

<!-- PROJECT -->
<section class="project section-padding" id="project">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-12">

                <h2 class="mb-5 text-center" data-aos="fade-up">
                    Department and Division Heads can easily <strong>review and approve IPCR and OPCR Forms</strong>
                </h2>

                <div class="owl-carousel owl-theme" id="project-slide">
                    <div class="item project-wrapper" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{asset('welcomepageimages/myteamevaluationforms.png')}}" class="img-fluid" alt="project image">
                        <div>
                            <h4 style="color: black; font-style: italic;">
                                <center>
                                    <span>My Team Evaluation Forms View</span>
                                </center>

                            </h4>
                        </div>
                    </div>

                    <div class="item project-wrapper" data-aos="fade-up">
                        <img src="{{asset('welcomepageimages/editform.png')}}" class="img-fluid" alt="project image">
                        <div>
                            <h4 style="color: black; font-style: italic;">
                                <center>
                                    <span>Edit and Approval</span>
                                </center>

                            </h4>
                        </div>
                    </div>

                    <div class="item project-wrapper" data-aos="fade-up">
                        <img src="{{asset('welcomepageimages/conditional.png')}}" class="img-fluid" alt="project image">
                        <div>
                            <h4 style="color: black; font-style: italic;">
                                <center>
                                    <span>Conditional Formatting for easy viewing of Total Weighted Score(Rating)</span>
                                </center>

                            </h4>
                        </div>
                    </div>

                    <div class="item project-wrapper" data-aos="fade-up">
                        <img src="{{asset('welcomepageimages/accountapproval.png')}}" class="img-fluid" alt="project image">
                        <div>
                            <h4 style="color: black; font-style: italic;">
                                <center>
                                    <span>Account Approval for New Register Account</span>
                                </center>

                            </h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<footer class="site-footer" id="footer">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 mx-lg-auto col-md-12 col-12">
                <h1 class="text-white" data-aos="fade-up" data-aos-delay="100">Bachelor of Technology in Information Technology</h1>
                <h1 class="text-white" data-aos="fade-up" data-aos-delay="100"><strong style="color: #f1c111">Development Team</strong></h1>
            </div>

            <div class="col-lg-3 col-md-3 col-12" data-aos="fade-up" data-aos-delay="200">
                <h4 class="my-5">Rico Santos</h4>
                <strong style="color: #f1c111">Project Technical Adviser</strong>
            </div>


            <div class="col-lg-3 col-md-3 col-12" data-aos="fade-up" data-aos-delay="200">
                <h4 class="my-5">Edward Del Rosario</h4>
                <strong style="color: #f1c111">BTIT Student</strong>
            </div>

            <div class="col-lg-3 col-md-3 col-12" data-aos="fade-up" data-aos-delay="300">
                <h4 class="my-5">George Asufra</h4>
                <strong style="color: #f1c111">BTIT Student</strong>
            </div>

            <div class="col-lg-3 col-md-3 col-12" data-aos="fade-up" data-aos-delay="300">
                <h4 class="my-5">Rhodnie Mataba</h4>
                <strong style="color: #f1c111">BTIT Student</strong>
            </div>

            <div class="col-lg-12 mx-lg-auto text-center col-md-12 col-12" data-aos="fade-up" data-aos-delay="400">
                <p class="copyright-text"><img src="images\tuptlogo.png" width="75px" height="75px"> <strong style="color: #f1c111"> Technological University of the Philippines - Taguig Campus </strong>
                    <br>
                    <strong style="color: #f1c111">Strategic Performance Management System</strong>

            </div>
        </div>
    </div>
</footer>


<!-- SCRIPTS -->
<script src="{{asset('welcomepagejs/jquery.min.js')}}"></script>
<script src="{{asset('welcomepagejs/bootstrap.min.js')}}"></script>
<script src="{{asset('welcomepagejs/aos.js')}}"></script>
<script src="{{asset('welcomepagejs/owl.carousel.min.js')}}"></script>
<script src="{{asset('welcomepagejs/smoothscroll.js')}}"></script>
<script src="{{asset('welcomepagejs/custom.js')}}"></script>

</body>
</html>
