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
            <form class="pt-3">
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
                                        <div class="col-md-4"><img src="./img/avatar1.png" alt="Avatar" class="avatar avatar1"/></div>
                                        <div class="col-md-4"><img src="./img/avatar2.png" alt="Avatar" class="avatar avatar2"/></div>
                                        <div class="col-md-4"><img src="./img/avatar3.png" alt="Avatar" class="avatar avatar3"/></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"><img src="./img/avatar4.png" alt="Avatar" class="avatar avatar4"/></div>
                                        <div class="col-md-4"><img src="./img/avatar5.png" alt="Avatar" class="avatar avatar5"/></div>
                                        <div class="col-md-4"><img src="./img/avatar6.png" alt="Avatar" class="avatar avatar6"/></div>
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
                    <div class="input-field bg-white"> <span class="fas fa-user p-2"></span> <input type="text"  id ="userName" name = "userName" placeholder="Enter your Username" required class=""> </div>
                </div>
                <div class="form-group py-2">
                    <div class="input-field bg-white"> <span class="fas fa-envelope p-2"></span> <input type="email" id ="email" name = "email" placeholder="Enter your Email Address" required class=""> </div>
                </div>
                <div class="form-group py-2">
                    <div class="input-field bg-white"> <span class="fa fa-phone p-2"></span> <input type="tel" id ="phone" name = "phone" placeholder="Enter your Phone Number" required class="" pattern="[0-9]{11}"> </div>
                </div>
                <div class="form-group py-2 pb-2">
                    <div class="input-field bg-white"> <span class="fas fa-lock p-2"></span> <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter your Password" required class=""> <button class="btn bg-white text-muted" onclick="password_show_hide();">
                            <i class="fas fa-eye" id="show_eye"></i>
                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i> </button>
                    </div>
                </div>
                <div class="form-group py-2 pb-2">
                    <div class="input-field bg-white"> <span class="fas fa-lock p-2"></span> <input type="password" id="retypepassword" name="retypepassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Repeat your Password" required class=""> <button class="btn bg-white text-muted" onclick="retypepassword_show_hide();">
                            <i class="fas fa-eye" id="show_eye2"></i>
                            <i class="fas fa-eye-slash d-none" id="hide_eye2"></i> </button>
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

                <div class="d-flex align-items-start">
                    <div class="form-text"> <label class="option text-muted"> By submitting this form, I agree to LGTL Cineplex's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>. I hereby confirm that the information provided is accurate, complete and up-to-date. <input type="checkbox" name="checkbox"> <span class="checkmark"></span> </label> </div>
                </div >
                <button id = "submit-registerform-btn" class="btn btn-block text-center my-3 fs-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Submit</button>
                <div class="text-center pt-3 text-muted">Already Member? <a href="#">Login here</a></div>
            </form>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <script src="https://smtpjs.com/v3/smtp.js"></script>


        <?php include "register_form_backend.php" ?>
        <script>
                        var OTP = "";
                        var selectImg = $("#avatar-img").attr('src');

                        $(".avatar").on('click', function (e) {
                            e.preventDefault();
                            selectImg = e.target.getAttribute('src');
                            console.log(selectImg);
                        })

                        $("#img-confirm").on('click', function (e) {
                            e.preventDefault();
                            $("#avatar-img").attr('src', selectImg);
                            $("#staticPicture").modal('hide');
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
                                alert(custObj);
                                console.log(custObj);
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
                                        window.location.href = "http://localhost/LGTL_Cineplex/LGTL_cinema/home_page/home_page.php";
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
                                "subj": "LGTL Account activation",
                                "msgBody": "Dear : " + $("#userName").val() + " Your OTP is " + OTP
                            };

                            sendEmail(dataObj);

                            $("#otp-msg").textContent = "We will be sending your LGTL OTP code to the email address, " + $("#email").val() + ".";
                        }

                        $("#submit-registerform-btn").on('click', function (e) {
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
                        function retypepassword_show_hide() {
                            var y = document.getElementById("retypepassword");
                            var show_eye2 = document.getElementById("show_eye2");
                            var hide_eye2 = document.getElementById("hide_eye2");
                            hide_eye2.classList.remove("d-none");
                            if (y.type === "password") {
                                y.type = "text";
                                show_eye2.style.display = "none";
                                hide_eye2.style.display = "block";
                            } else {
                                y.type = "password";
                                show_eye2.style.display = "block";
                                hide_eye2.style.display = "none";
                            }
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
                        });</script>

        <script>
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
            }</script>
    </body>
</html>