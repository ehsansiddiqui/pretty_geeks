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
    <title>Sign Up</title>
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

                <form method="post" action="input-box-form" id="signupform">
                    @csrf
                    <div class="input-box input-box-red">
                        <h3>Welcome to The Pretty Geeks</h3>
                        <div class="alert" id="msg_div" style="display:none">
                            <ul id="res_message"></ul>
                        </div>
                        <div class="input-field">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="text" placeholder="Full Name" name="name" required="required"/>
                            <div class="alert-message" id="nameError"></div>

                        </div>
                        <div class="input-field">
                            <img src={{asset("icons/icon-message.svg")}} alt="" />
                            <input type="email" placeholder="Email Address" name="email" required="required"/>
                            <div class="alert-message" id="emailError"></div>
                        </div>
                        <div class="input-field">
                            <img src={{asset("icons/icon-lock.svg")}} alt="" />
                            <input type="password" placeholder="Password" name="password" required="required" />
                            <div class="alert-message" id="passwordError"></div>

                        </div>
                        <div class="input-field">
{{--                            <ion-icon name="calendar-outline"></ion-icon>--}}
                            <input type="date" placeholder="Date Of Birth" name="dob" required="required"/>
                            <div class="alert-message" id="dobError"></div>

                        </div>
                        <div class="input-field">
{{--                            <select>--}}
{{--                                <option value="">+92</option>--}}
{{--                            </select>--}}
                            <ion-icon name="call-outline"></ion-icon>
                            <input type="text" placeholder="Phone Number" name="mobile_number" required="required" />
                            <div class="alert-message" id="mobileNumberError"></div>
                        </div>
                        <div class="input-check">
                            <div class="single-check">
                                <input type="radio" id="male" name="sex" value="Male" checked="checked"/>
                                <label for="male">
                                    <span class="gender-radio"></span>
                                    Male</label
                                >
                            </div>
                            <div class="single-check">
                                <input type="radio"  id="female" name="sex" value="Female"/>
                                <label for="female">
                                    <span class="gender-radio"></span>

                                    Female</label
                                >
                            </div>
                            <div class="alert-message" id="sexError"></div>

                        </div>
                        <div class="button-box">
                            <a href="#"  id="btnsignup" type="submit" class="btn-red">Signup</a>
                            <a href={{route('login-reg')}} class="btn-red-outline">Login</a>
                        </div>
                        <p>or signup with</p>
                        <div class="button-box">
                            <a href="#" class="btn-social">
                                <img src={{asset("icons/icon-google.svg")}} alt="" />
                            </a>
                            <a href="#" class="btn-social">
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
<script src={{asset("js/main.js")}}></script>
<script src={{asset("js/main.min.js")}}></script>
<script src={{asset("js/script.js")}}></script>
<script src={{asset("js/map-init.js")}}></script>
<script src={{asset("js/login.js")}}></script>
</body>
</html>
