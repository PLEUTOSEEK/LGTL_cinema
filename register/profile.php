<?php ?>

<!DOCTYPE html>

<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href=".css"/>
        
        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

        <link rel="stylesheet" href="profile.css?v=<?php echo time(); ?>">

        <title>LGTL Cineplex - Profile</title>
    </head>
    <body>

        <?php
        include '../nav_bar/navigation_bar.php';
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <script src="https://smtpjs.com/v3/smtp.js"></script>


        <script>
            $(function () {
                var custDtls = <?php echo json_encode($_SESSION['logInCustomer']); ?>;
            })
        </script>
        <br>
        <div class="container rounded mt-5 mb-5 text-white">
            <div class="row">
                <div class="col-                md-5 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img id="avatar-img" class="avatar rounded-circle mt-5" src="data:image/jpg;charset=utf8;base64,<?php echo $_SESSION['logInCustomer']['customer_image'] ?>"><span class="font-weight-bold text-white"><input type="file" accept="image/*" id="imgupload" class = "" style="display:none" value = ""/><button class="btn btn-primary mt-4 editable-input" id="OpenImgUpload" disabled="">Change Avatar</button></span><span> </span></div>
                </div>
                <div class="col-md-6 border-left ps-5">
                    <div class="p-3 pt-5 pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <form id ="custDtlsForm">
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Username</label><input type="text" id="user-name" name = "user-name" required class="form-control editable-input" value="<?php echo $_SESSION['logInCustomer']['cust_name'] ?>" disabled="true"></div>
                                <div class="col-md-12"><label class="labels">PhoneNumber</label><input type="tel" id="phone-number" name = "phone-number" required class="form-control editable-input" value="<?php echo $_SESSION['logInCustomer']['phone_no'] ?>" disabled="true"></div>
                                <div class="col-md-12"><label class="labels">Email</label><input type="email" id = "email" name = "email" required class="form-control editable-input" value="<?php echo $_SESSION['logInCustomer']['email'] ?>" disabled="true"></div>
                                <div class="col-md-12"><label class="labels">Password</label>
                                    <div class="input-field bg-white">
                                        <input type="password" id="password" name = "password" pattern="/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/" required class="form-control editable-input" value="<?php echo $_SESSION['logInCustomer']['password'] ?>" disabled="true">
                                        <span class="btn bg-white text-muted" onclick="password_show_hide();">
                                            <i class="fas fa-eye" id="show_eye"></i>
                                            <i class="fas fa-eye-slash d-none" id="hide_eye"></i> 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row px-3">
                            <div class="mt-5 text-left" id = "show-up-conditional" style="visibility: hidden;"><button id = "cancel-btn" class="btn btn-primary profile-button" type="button">Cancel Edit</button></div>
                            <div class="ml-auto mt-5 text-right"><button id = "edit-btn" class="btn btn-primary profile-button" type="button">Edit Profile</button></div>
                        </div>

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
                                                <a href="#" id="resend-otp-link">resend OTP</a>
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

                    </div>
                    <hr style="background: white">
                    <div class="my-4 text-center"><button class="btn btn-primary profile-button" id = "view-order-btn" type="button">View My Order</button></div>
                </div>
            </div>
        </div>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

        <script>
            var OTP = "";

            $('#OpenImgUpload').click(function () {
                $('#imgupload').trigger('click');

            });

            $("#imgupload").change(function () {
                readURL(this);
            });

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

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        //alert(e.target.result);
                        $('#avatar-img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#view-order-btn").on('click', function () {
                window.location.href = "http://localhost/LGTL_Cineplex/LGTL_cinema/ticket_booking/refundsOverview.php";
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


            var form = $("#custDtlsForm");
            form.validate({
                rules: {
                    'user-name': {
                        required: true
                    },
                    'password': {
                        required: true,
                        passwordrequirement: true
                    },
                    'phone-number': {
                        required: true,
                        phoneValidation: true
                    },
                    'email': {
                        required: true,
                        emailValidation: true
                    }
                },
                messages: {
                    'user-name': "This field required",
                    'email': "Incorrect email format",
                    'password': "Incorrect password format",
                    'phone-number': 'Incorrect phone number format'
                }
            });

            $.validator.addMethod("passwordrequirement", function (value, element) {
                var rg = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;

                return $("#password").val().match(rg);
            });

            $.validator.addMethod("phoneValidation", function (value, element) {
                var rg = /^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/;

                return $("#phone-number").val().match(rg);
            });

            $.validator.addMethod("emailValidation", function (value, element) {
                var rg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                return $("#email").val().match(rg);
            });


            $("#edit-btn").on('click', function (e) {
                e.preventDefault();

                var self = $(this);
                if (self.text().toUpperCase() == "EDIT PROFILE") {
                    $(".editable-input").removeAttr('disabled');
                    $("#show-up-conditional").css('visibility', 'visible');
                    self.text("Save Profile");
                } else {
                    if (form.valid()) {
                        $("#show-up-conditional").css('visibility', 'hidden');
                        $(".editable-input").attr('disabled', 'true');
                        self.text("Edit Profile");
                        var custData = {
                            "cust_name": $("#user-name").val(),
                            "email": $("#email").val(),
                            "password": $("#password").val(),
                            "customer_image": $("#avatar-img").attr('src'),
                            "phone_no": $("#phone-number").val()
                        }

                        console.log(custData);
                        $.ajax({
                            //update data
                            type: "POST",
                            url: "profileBackEnd.php",
                            data: {
                                "action": "updateProfileFunc",
                                "data": JSON.stringify(custData)
                            },
                            error: function (xhr, status, error) {
                                console.log("Error: " + error);
                            },
                            success: function (result, status, xhr) {

                            }
                        });
                    } else {
                        alert("fields not match");
                    }
                }

            })

            $("#cancel-btn").on('click', function (e) {
                $("#show-up-conditional").css('visibility', 'hidden');
                $(".editable-input").attr('disabled', 'true');
                $("#edit-btn").text("Edit Profile");

                $("#user-name").val('<?php echo $_SESSION['logInCustomer']['cust_name'] ?>');
                $("#email").val('<?php echo $_SESSION['logInCustomer']['email'] ?>');
                $("#password").val('<?php echo $_SESSION['logInCustomer']['password'] ?>');
                $("#avatar-img").attr('src', '<?php echo $_SESSION['logInCustomer']['customer_image'] ?>');
                $("#phone-number").val('<?php echo $_SESSION['logInCustomer']['phone_no'] ?>');

                location.reload();
            })

        </script>

        <?php
        include '../nav_bar/footer.php';
        ?>
    </body>
</html>
