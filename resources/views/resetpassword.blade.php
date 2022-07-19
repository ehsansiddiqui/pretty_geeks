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
                            <img src={{asset("svgs/vector-7.svg")}} alt="" />
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
                <form action="{{route('setnewpassword')}}" class="input-box-form" method="post">
                    @csrf
                    <div class="input-box input-box-forgot">
                        <h3 class="text-center text-md-left">Welcome to The Pretty Geeks</h3>


{{--                        @if ($errors->any())--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <ul>--}}
{{--                                    @foreach ($errors->all() as $error)--}}
{{--                                        <li>{{ $error }}</li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input-field">
                            <img src={{asset("icons/icon-lock.svg")}} alt="" />
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password" required/>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-field">
                            <img src={{asset("icons/icon-lock.svg")}} alt="" />
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" placeholder="Confirm New Password" required/>
                            @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
{{--                        <div class="input-field">--}}
{{--                            <select>--}}
{{--                                <option value="">+92</option>--}}
{{--                            </select>--}}
{{--                            <input type="password" placeholder="Phone Number" />--}}
{{--                        </div>--}}
{{--                        <p class="text-left">--}}
{{--                            A link has been sent to your email address to recover password.--}}
{{--                        </p>--}}

                        <div class="button-box">
{{--                            <a href="#" class="btn-yellow">Login</a>--}}
{{--                            <a href="#" class="btn-yellow-outline">Reset Password</a>--}}
                            <button class="btn-yellow" type="submit">Reset Password</button>
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
</body>
</html>
