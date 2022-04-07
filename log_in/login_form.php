<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"/>

        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

        <!-- login form CSS -->
        <link rel="stylesheet" href="login_form.css?v=<?php echo time(); ?>">

        <title>LGTL Cineplex - Log In</title>
    </head>
    <body style="background-color: rgb(16,27,44)">

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <div class="wrapper bg-dark">
            <div class="h2 text-center text-white">Welcome back!</div>
            <div class="h4 text-muted text-center pt-2">Enter your login details</div>
            <form class="pt-3">
                <div class="form-group py-2">
                    <div class="input-field bg-white"> <span class="fas fa-envelope p-2"></span> <input type="email" id = "email" placeholder="Enter your Email Address" required class=""> </div>
                </div>
<<<<<<< HEAD
                <div class="form-group py-1 pb-2">
                    <div class="input-field bg-white"> <span class="fas fa-lock p-2"></span> <input type="password" id="password"  placeholder="Enter your Password" required class=""> <button class="btn bg-white text-muted" onclick="password_show_hide();">
                            <i class="fas fa-eye" id="show_eye"></i>
                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i> </button>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="remember"> <label class="option text-muted"> Remember me <input type="checkbox" name="checkbox"> <span class="checkmark"></span> </label> </div>
                    <div class="ml-auto"> <a href="#" id="forgot">Forgot Password?</a> </div>
                </div >
                <button class="btn btn-block text-center my-3" id = "login-btn">Log in</button>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p id = "otp-msg">We will be sending your LGTL OTP code to the email address, example@gmail.com.</p>

                                <div class="card p-2 text-center mb-3 mt-1 bg-dark text-white">
                                    <div class="form-text text-left">Verification</div>
                                    <div id="otp" class="inputs d-flex flex-row justify-content-center">
                                        <input class="ms-5 me-3 text-center form-control rounded" type="text" id="first" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="second" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="third" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="fourth" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="fifth" maxlength="1" />
                                        <input class="me-5 text-center form-control rounded" type="text" id="sixth" maxlength="1" />
                                    </div>
                                </div>
                            </div>
                            <div class="justify-content-start resend-otp-container">
                                <a id="resend-otp-link">resend OTP</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-warning" id="otp-confirm">Confirm</button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-center pt-3 text-muted">Not a member? <a href="#">JOIN NOW</a></div>
            </form>


        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <script src="https://smtpjs.com/v3/smtp.js"></script>

        <script>
                        var OTP = "";
                        var fetchAssockList;
                        $("#login-btn").on('click', function (e) {
                            e.preventDefault();
                            var loginDtls = {
                                "email": $("#email").val(),
                                "pass": $("#password").val()
                            }

                            $.ajax({
                                type: "POST",
                                url: "login_form_backend.php",
                                data: {
                                    "action": "validateLogInFunc",
                                    "loginDtls": JSON.stringify(loginDtls)
                                },
                                error: function (xhr, status, error) {
                                    console.log("Error: " + error);
                                },
                                success: function (result, status, xhr) {
                                    fetchAssockList = JSON.parse(result);
                                    if (fetchAssockList != "null") {
                                        readySendEmail(fetchAssockList);
                                        $("#staticBackdrop").modal('show');
                                    } else {
                                        alert("Email or password incorrect, please try again");
                                    }
                                }
                            });
                        })

                        $("#otp-confirm").on('click', function (e) {
                            e.preventDefault();

                            var completeOTPInput = "";

                            completeOTPInput = completeOTPInput.concat(
                                    $("#first").val(),
                                    $("#second").val(),
                                    $("#third").val(),
                                    $("#fourth").val(),
                                    $("#fifth").val(),
                                    $("#sixth").val());
                            if (OTP == completeOTPInput && OTP != "") {
                                $.ajax({
                                    url: "login_form_backend.php",
                                    type: "POST",
                                    data: {
                                        "action": "openCustomerSessionFunc",
                                        "custDtls": JSON.stringify(fetchAssockList)
                                    },
                                    error: function (xhr, status, error) {
                                        console.log("Error: " + error);
                                    },
                                    success: function (result, status, xhr) {
                                        alert("Welcome back " + fetchAssockList['cust_name']);
                                        window.location.href = "http://localhost/LGTL_Cineplex/LGTL_cinema/home_page/home_page.php";
                                    }
                                })
                            } else {
                                alert("OTP incorrect, please try again.");
                            }
                        })

                        $("#resend-otp-link").on('click', function (e) {
                            e.preventDefault();
                            readySendEmail();
                        })

                        function password_show_hide() {
                            var x = document.getElementById("password");
                            var show_eye = document.getElementById("show_eye");
                            var hide_eye = document.getElementById("hide_eye");
                            hide_eye.classList.remove("d-none");
                            if (x.type === "password") {
                                x.type = "text";
                                show_eye.style.display = "none";
                                hide_eye.style.display = "block";
                            } else {
                                x.type = "password";
                                show_eye.style.display = "block";
                                hide_eye.style.display = "none";
                            }
                        }

                        function readySendEmail(dtls) {
                            OTP = Math.floor(100000 + Math.random() * 900000);
                            var dataObj = {
                                "email": dtls['email'],
                                "subj": "LGTL Account activation",
                                "msgBody": "Dear : " + dtls['cust_name'] + " Your OTP is " + OTP
                            };
                            sendEmail(dataObj);
                            $("#otp-msg").text("We will be sending your LGTL OTP code to the email address, " + dtls['email'] + ".");
                        }

                        function sendEmail(data) {
                            Email.send({
                                Host: "smtp.gmail.com",
                                Username: "teezx-wm19@student.tarc.edu.my",
                                Password: "sgxdjzbeaiqqvgim",
                                To: data['email'],
                                From: "teezx-wm19@student.tarc.edu.my",
                                Subject: data['subj'],
                                Body: data['msgBody']
                                        //+"<br> Rate : " + document.getElementById("comment").value
                            }).then(
                                    message => alert("Message Sent Successfully")
                            );
                        }

                        document.addEventListener("DOMContentLoaded", function (event) {

                            function OTPInput() {
                                const inputs = document.querySelectorAll('#otp > *[id]');
                                for (let i = 0; i < inputs.length; i++) {
                                    inputs[i].addEventListener('keydown', function (event) {
                                        if (event.key === "Backspace") {
                                            inputs[i].value = '';
                                            if (i !== 0)
                                                inputs[i - 1].focus();
                                        } else {
                                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                                return true;
                                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                                inputs[i].value = event.key;
                                                if (i !== inputs.length - 1)
                                                    inputs[i + 1].focus();
                                                event.preventDefault();
                                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                                inputs[i].value = String.fromCharCode(event.keyCode);
                                                if (i !== inputs.length - 1)
                                                    inputs[i + 1].focus();
                                                event.preventDefault();
                                            }
                                        }
                                    });
                                }
                            }
                            OTPInput();
                        });
        </script>
    </body>
=======
            </div>
            <div class="d-flex align-items-start">
                <div class="ml-auto"> <a href="#" id="forgot">Forgot Password?</a> </div>
            </div > 
            <button class="btn btn-block text-center my-3">Log in</button>
            <div class="text-center pt-3 text-muted">Not a member? <a href="#">JOIN NOW</a></div>
        </form>
    </div>
    
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
              x.type = "text";
              show_eye.style.display = "none";
              hide_eye.style.display = "block";
            } else {
              x.type = "password";
              show_eye.style.display = "block";
              hide_eye.style.display = "none";
            }
        }
    </script>
  </body>
>>>>>>> 34d744e5348aa2859141f67f41ed28d944b22f2a
</html>