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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"/>

        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

        <!-- login form CSS -->
        <link rel="stylesheet" href="login_form.css?v=<?php echo time(); ?>">

        <title>LGTL Cineplex - Forget Password</title>
    </head>
    <body style="background-color: rgb(16,27,44)">

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <div class="wrapper bg-dark">
            <div class="h2 text-center text-white">Forgot your password?</div>
            <div class="h4 text-muted text-center pt-2">Don't worry! Just fill in your email and we'll send you a new password.</div>
            <form class="pt-3">
                <div class="form-group py-2">
                    <div class="input-field bg-white"> <span class="fas fa-envelope p-2"></span> <input id = "email" type="email" placeholder="Enter your Email Address" required class=""> </div>
                </div>

                <!-- Button trigger modal -->
                <button class="btn btn-block text-center my-3" id = "reset-btn">Reset password</button>
                <!-- Modal -->
                <div class="modal fade" id="notifyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                please check your email to get your new password.
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="ok-btn" class="btn btn-primary"data-bs-dismiss="modal" >OK</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <?php
        // put your code here
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <script src="https://smtpjs.com/v3/smtp.js"></script>

        <script>
            $("#ok-btn").on('click', function (e) {
                window.location.href = "http://localhost/LGTL_Cineplex/LGTL_cinema/log_in/login_form.php";
            })

            $("#reset-btn").on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "forget_password_form_backend.php",
                    data: {
                        "action": "checkEmailExistanceFunc",
                        "email": $('#email').val()
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    },
                    success: function (result, status, xhr) {

                        var fetchAssocList = JSON.parse(result);

                        if (fetchAssocList != "null") {
                            console.log(fetchAssocList);
                            readySendEmail(fetchAssocList);
                            $("#notifyModal").modal('show');

                        } else {
                            alert("email not existed...");
                        }
                    }
                });
            })

            function readySendEmail(dtls) {
                OTP = Math.floor(100000 + Math.random() * 900000);
                var dataObj = {
                    "email": dtls['email'],
                    "subj": "LGTL Reset Password",
                    "msgBody": "Dear : " + dtls['cust_name'] + " Your new password is " + dtls['newPass']
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
        </script>
    </body>
</html>
