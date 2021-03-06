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

        <link rel="stylesheet" href="register_form.css?v=<?php echo time(); ?>">

        <title>LGTL Cineplex - Register</title>
    </head>
    <body style="background-color: rgb(16,27,44)">
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <div class="wrapper bg-dark">
            <div class="h2 text-center text-white">Sign Up</div>
            <div class="h4 text-muted text-center pt-2">Enter your account details</div>
            <form class="pt-3" id="custDtlsForm">
                <div class="text-center"><img src="./img/avatar0.png" alt="Avatar" class="avatar avatar0" id="avatar-img"/></div>
                <!-- Button trigger modal -->
                <div class="text-center"><button class="btn btn-outline-light text-center mt-3 px-4" data-bs-toggle="modal" data-bs-target="#staticPicture">Choose Profile Picture</button></div>
                <!-- Modal -->
                <div class="modal fade" id="staticPicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Pick an Avatar</h5>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row pb-2">
                                        <div class="image col-md-4"><img src="./img/avatar1.png" alt="Avatar" class="avatar avatar1"/></div>
                                        <div class="image col-md-4"><img src="./img/avatar2.png" alt="Avatar" class="avatar avatar2"/></div>
                                        <div class="image col-md-4"><img src="./img/avatar3.png" alt="Avatar" class="avatar avatar3"/></div>
                                    </div>
                                    <div class="row">
                                        <div class="image col-md-4"><img src="./img/avatar4.png" alt="Avatar" class="avatar avatar4"/></div>
                                        <div class="image col-md-4"><img src="./img/avatar5.png" alt="Avatar" class="avatar avatar5"/></div>
                                        <div class="image col-md-4"><img src="./img/avatar6.png" alt="Avatar" class="avatar avatar6"/></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="img-cancel">Cancel</button>
                                <button type="button" class="btn btn-warning" id="img-confirm" data-bs-dismiss="modal">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group py-2">
                    <div class="input-field bg-white"> <span class="fas fa-user p-2"></span> <input type="text"  id ="userName" name = "userName" placeholder="Enter your Username" required> </div>
                </div>
                <div class="form-group py-2">
                    <div class="input-field bg-white"> <span class="fas fa-envelope p-2"></span> <input type="email" id ="email" name = "email" placeholder="Enter your Email Address" required class=""> </div>
                </div>
                <div class="form-group py-2">
                    <div class="input-field bg-white"> <span class="fa fa-phone p-2"></span> <input type="tel" id ="phone" name = "phone" placeholder="Enter your Phone Number" required class="" > </div>
                </div>
                <div class="form-group py-2 pb-2">
                    <div class="input-field bg-white"> <span class="fas fa-lock p-2"></span>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" required class="password-input">
                        <button class="btn bg-white text-muted eye-trigger-btn">
                            <i class="fas fa-eye eye-img" id="show_eye"></i>
                            <i class="fas fa-eye-slash d-none eye-img" id="hide_eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group py-2 pb-2">
                    <div class="input-field bg-white"> <span class="fas fa-lock p-2"></span>
                        <input type="password" id="retypepassword" name="retypepassword"  placeholder="Repeat your Password" required class="password-input">
                        <button class="btn bg-white text-muted eye-trigger-btn">
                            <i class="fas fa-eye eye-img" id="show_eye2"></i>
                            <i class="fas fa-eye-slash d-none eye-img" id="hide_eye2"></i>
                        </button>
                    </div>
                </div>
                <div id="passwordHelpBlock" class="form-text">
                    Password must:<br>Contain minimum 8 characters<br>Include at least one number and symbol.<br>Include both upper and lower case letters.
                </div>

                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p id = "otp-msg">We will be sending your LGTL OTP code to the email address, example@gmail.com.</p>

                                <div class="card p-2 text-center mb-3 mt-1">
                                    <div class="form-text text-left">Verification</div>
                                    <div id="otp" class="inputs d-flex flex-row justify-content-center">
                                        <input class="ms-5 me-3 text-center form-control rounded" type="text" id="first" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="second" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="third" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="fourth" maxlength="1" />
                                        <input class="me-3 text-center form-control rounded" type="text" id="fifth" maxlength="1" />
                                        <input class="me-5 text-center form-control rounded" type="text" id="sixth" maxlength="1" />
                                    </div>
                                    <div class="justify-content-start resend-otp-container mt-2">
                                        <a href="#" id="resend-otp-link" style="color: blue">resend OTP</a>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-warning" id="otp-confirm">Confirm</button>
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="form-text">
                    By submitting this form, I agree to LGTL Cineplex's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>. I hereby confirm that the information provided is accurate, complete and up-to-date.
                </div>
                <button class="btn btn-block text-center my-3 fs-5" id = "submit-registerform-btn" >Submit</button>
                <div class="text-center pt-3 text-muted">Already Member? <a href="../log_in/login_form.php">Login here</a></div>
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <script src="https://smtpjs.com/v3/smtp.js"></script>

        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <?php include "register_form_backend.php" ?>
        <script>
            var OTP = "";
            var selectImg = $("#avatar-img").attr('src');



            $(".avatar").on('click', function (e) {
                e.preventDefault();
                selectImg = e.target.getAttribute('src');
            })

            $("#img-confirm").on('click', function (e) {
                e.preventDefault();

                $("#avatar-img").attr('src', selectImg);
            })

            $("#resend-otp-link").on('click', function (e) {
                e.preventDefault();
                readySendEmail();
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
                if (completeOTPInput == OTP && OTP != "") {

                    var custObj = {
                        "cust_img": $("#avatar-img").attr('src'),
                        "user_name": $("#userName").val(),
                        "email": $("#email").val(),
                        "pass": $("#password").val(),
                        "phone": $("#phone").val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "register_form_backend.php",
                        data: {
                            "action": "insertNewRegisterCustFunc",
                            "custDtls": JSON.stringify(custObj)
                        },
                        error: function (xhr, status, error) {
                            console.log("Error: " + error);
                        },
                        success: function (result, status, xhr) {
                            alert("Register successfully");
                            window.location.href = "http://localhost/LGTL_Cineplex/LGTL_cinema/log_in/login_form.php";
                        }
                    });
                } else {
                    alert("OTP incorrect, please try again.");
                }
            })

            function readySendEmail() {
                OTP = Math.floor(100000 + Math.random() * 900000);
                var dataObj = {
                    "email": $("#email").val(),
                    "subj": "Verify Your Email",
                    "msgBody": "Hello " + $("#userName").val() + ",\n\nThank you for sign up at LGTL Cineplex.\nPlease verify your email.\nYour OTP number is " + OTP + ".\n\nThank you."
                };
                sendEmail(dataObj);
                $("#otp-msg").text("We will be sending your LGTL OTP code to the email address, " + $("#email").val() + ".");
            }

            var form = $("#custDtlsForm");
            form.validate({
                rules: {
                    'userName': {
                        required: true
                    },
                    'retypepassword': {
                        required: true,
                        RetypePasswordValidation: true
                    },
                    'password': {
                        required: true,
                        passwordrequirement: true
                    },
                    'phone': {
                        required: true,
                        phoneValidation: true
                    },
                    'email': {
                        required: true,
                        emailValidation: true
                    }
                },
                messages: {
                    'userName': "This field required",
                    'email': "Incorrect email format",
                    'password': "Incorrect password format",
                    'retypepassword': "Please match with the password",
                    'phone': 'Incorrect phone number format'
                }
            });

            $.validator.addMethod("RetypePasswordValidation", function (value, element) {
                return $("#password").val() === $("#retypepassword").val();
            });

            $.validator.addMethod("passwordrequirement", function (value, element) {
                var rg = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

                return $("#password").val().match(rg);
            });

            $.validator.addMethod("phoneValidation", function (value, element) {
                var rg = /^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/;

                return $("#phone").val().match(rg);
            });

            $.validator.addMethod("emailValidation", function (value, element) {
                var rg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                return $("#email").val().match(rg);
            });

            $("#submit-registerform-btn").on('click', function (e) {
                e.preventDefault();

                if (form.valid()) {
                    $.ajax({
                        type: "POST",
                        url: "register_form_backend.php",
                        data: {
                            "action": "checkUniqueEmailFunc",
                            "email": $("#email").val()
                        },
                        error: function (xhr, status, error) {
                            console.log("Error: " + error);
                        },
                        success: function (result, status, xhr) {
                            if (result == 0) {
                                $("#staticBackdrop").modal('show');
                                readySendEmail();
                            } else {
                                alert("Email existed, please try again...");
                            }
                        }
                    });
                } else {
                    alert("fields not match");
                }
            })

            $(".eye-trigger-btn").on('click', function (e) {
                e.preventDefault();
                var x = $(this).siblings('.password-input');
                var show_eye = $(this).children(":first-child");
                var hide_eye = $(this).children(":last-child");
                hide_eye.removeClass("d-none");
                show_eye.removeClass("d-none");

                if (x.prop('type') === "password") {
                    x.attr("type", "text");
                    show_eye.attr("display", "none");
                    show_eye.addClass("d-none");
                    hide_eye.attr("display", "block");
                } else {
                    x.attr("type", "password");
                    show_eye.attr("display", "block");
                    hide_eye.attr("display", "none");
                    hide_eye.addClass("d-none");
                }
            })

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
        </script>
    </body>
</html>