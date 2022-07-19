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
    <title>Forgot Password</title>
</head>
<body>
<main class="main">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8 col-xl-8">
                <div class="figures">
                    <div class="figure-box">
                        <figure class="figure-forgot">
                            <img src="svgs/vector-7.svg" alt="" />
                        </figure>
                    </div>
                    <div class="color">
                        <div class="color-box">
                            <div class="active-color yellow"></div>
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
                <form action="{{route('resetpassword')}}" class="input-box-form" method="post">
                    @csrf
                    <div class="input-box input-box-forgot">
                        <h3 class="text-center text-md-left">Welcome to The Pretty Geeks</h3>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <div class="input-field">
                            <img src="icons/icon-message.svg" alt="" />
                            <input type="email" name="email" placeholder="Email Address" required />
                        </div>
                        <div class="input-field">
                            <select>
                                <option value="">+92</option>
                            </select>
                            <input type="text" name="mobile_number" placeholder="Phone Number" required />
                        </div>
                        <p class="text-left">
                            A link has been sent to your email address to recover password.
                        </p>

                        <div class="button-box">
{{--                            <a href="#" class="btn-yellow" type="submit">Send Email</a>--}}
                            <button class="btn-yellow" type="submit">Send Email</button>
                            <a href={{route('login-reg')}}  class="btn-yellow-outline">Login</a>
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
<script src={{asset("https://unpkg.com/ionicons@5.2.3/dist/ionicons.js")}}></script>
{{--<script src={{asset("js/main.js")}}></script>--}}
<script src={{asset("js/main.min.js")}}></script>
<script src={{asset("js/script.js")}}></script>
<script src={{asset("js/map-init.js")}}></script>
<script src={{asset("js/login.js")}}></script>
</body>
</html>
