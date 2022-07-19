<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Font Awesome Script -->
    <!-- <script src="https://kit.fontawesome.com/7ae40850c4.js" crossorigin="anonymous"></script> -->
    <!-- Font Awesome Css -->
    <link rel="stylesheet" href={{asset("css/font-awesome/css/all.css")}} />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{asset("css/bootstrap.min.css")}} />
    <!-- Custom CSS -->
    <link rel="stylesheet" href={{asset("css/main.css")}} />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
</head>
<body>
<main class="main">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-8">
                <div class="figures">
                    <div class="figure-box">
                        <figure class="figure-1">
                            <img src={{asset("svgs/vector-1.svg")}} alt="" />
                        </figure>
                        <figure class="figure-2">
                            <img src={{asset("svgs/vector-2.svg")}} alt="" />
                        </figure>
                        <figure class="figure-3">
                            <img src={{asset("svgs/vector-3.svg")}} alt="" />
                        </figure>
                        <figure class="figure-4">
                            <img src={{asset("svgs/vector-4.svg")}} alt="" />
                        </figure>
                        <figure class="figure-5">
                            <img src={{asset("svgs/vector-5.svg")}} alt="" />
                        </figure>
                        <figure class="figure-6">
                            <img src={{asset("svgs/vector-6.svg")}} alt="" />
                        </figure>
                    </div>
                    <div class="color">
                        <div class="color-box">
                            <div class="active-color red"></div>
                            <span>Select your theme</span>
                        </div>
                        <div class="color-option">
                            <div class="color-row">
                                <div class="red"></div>
                                <div class="orange"></div>
                                <div class="yellow"></div>
                                <div class="green"></div>
                                <div class="red-2"></div>
                                <div class="purple"></div>
                            </div>
                            <div class="color-row">
                                <div class="blue"></div>
                                <div class="blue-2"></div>
                                <div class="blue-3"></div>
                                <div class="cyan"></div>
                                <div class="purple-2"></div>
                                <div class="purple-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xl-4">
                <form class="input-box-form" method="post" id="signinform">
                    @csrf
                    <div class="input-box input-box-red">
                        <div class="logo-box">
                            <h1 class="text-center">Logo</h1>
                        </div>
                        <h3 class="text-center text-md-left">Welcome to The Pretty Geeks</h3>
                        <div class="alert" id="msg_div" style="display:none">
                            <ul id="res_message"></ul>
                        </div>
                        <div class="input-field">
                            <img src={{asset("icons/icon-message.svg")}} alt="" />
                            <input type="email" placeholder="Email Address" name="email" required="required"/>
                        </div>
                        <div class="input-field">
                            <img src={{asset("icons/icon-lock.svg")}} alt="" />
                            <input type="password" placeholder="Password" name="password" required="required" />
                        </div>
                        <div class="input-check">
                            <div class="single-check">
                                <input type="radio" name="gender" id="male" />
                                <label for="male">
                                    <span class="gender-radio"></span>
                                    Remember me</label
                                >
                            </div>
                            <div class="forgot-box">
                                <a href={{route('forgetpassword')}}>Forgot password ?</a>
                            </div>
                        </div>
                        <div class="button-box">
                            <a href={{route('registration')}} class="btn-red">Signup</a>
                            <a href="#" id="btnsignin" class="btn-red-outline">Login</a>
                        </div>
                        <p>or signup with</p>
                        <div class="button-box">
                            <a href={{url('/redirect/google')}} class="btn-social">
                                <img src={{asset("icons/icon-google.svg")}} alt="" />
                            </a>
                            <a href={{url('/redirect/facebook')}} class="btn-social">
                                <img src={{asset("icons/icon-facebook.svg")}} alt="" />
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src={{asset("js/jquery.js")}}></script>
<script src={{asset("js/popper.js")}}></script>
<script src={{asset("js/bootstrap.min.js")}}></script>
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
{{--<script src={{asset("js/main.js")}}></script>--}}
<script src={{asset("js/main.min.js")}}></script>
<script src={{asset("js/script.js")}}></script>
<script src={{asset("js/map-init.js")}}></script>
<script src={{asset("js/login.js")}}></script>
</body>
</html>
