<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>

<body>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #004EDA;">
                <div class="featured-image mb-3">
                    <img src="{{ asset('images/logo2.png') }}" class="img-fluid" style="width: 100px;">
                </div>
                <p class="text-white fs-5 text-center" style="font-size: 10px; font-weight: 800;">Three Fe's Appliance Emporium</p>
                <small class="text-white fs-6 text-wrap text-center"
                    style="width: 20rem; ">Loan Management System</small>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

           <div class="col-md-6 right-box">
                <div class="row align-items-center">
                        <div class="header-text mb-4 text-center mt-5">
                            <h2 style="color: #004EDA; font-weight: 800;">Log In</h2>
                            <p>Log in to Get Started</p>
                        </div>
                        
                        <form action="{{ route('login.validate') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                            </div>
                            <div class="input-group mb-1">
                                <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                            </div>
                            <div class="input-group mb-5 d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="formCheck">
                                    <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                                </div>
                                <div class="forgot">
                                    <small><a href="#">Forgot Password?</a></small>
                                </div>
                            </div>
                            <div class="input-group mb-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>

</body>

</html>