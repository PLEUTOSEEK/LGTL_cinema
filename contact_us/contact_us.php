<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>LGTL Cineplex-Contact Us</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <style>
            /* HIDE RADIO */
            .rateOption{
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }
            .rateOption1{
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }
            .rateOption2{
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }
            .rateOption3{
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }
            .rateOption4{
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }
            .rateOption5{
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }

            /* IMAGE STYLES */
            [type=radio] + img {
                cursor: pointer;
            }

            .rateOptionBox{
                text-align: center;
            }

            input[type="radio"] {
                -ms-transform: scale(1.5); /* IE 9 */
                -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
                transform: scale(1.5);
            }

            .formdesign{
                background-color: #f5f5f5;
                border-radius: 10px;
                margin-top: 50px;
                margin-bottom: 100px;
            }
            .buttonStyle{
                border-radius: 10px;
                background: red;
                border-color: red;
            }
        </style>

    </head>
    <body>

        <?php
        include '../nav_bar/navigation_bar.php';
        //include 'connection.php';
        ?>

        <div class="formdesign container-fluid justify-content-center col-md-5 bg-dark">
            <h3 class="m-1 text-white text-center pt-3">Rate Your Experience</h3><br/>

            <div class="rateOptionBox">
                <label>
                    <input type="radio" value="1"name="rateOption" class="rateOption"/>
                    <img src="start_uncheck.png" class="rateImg">
                </label>
                <label>
                    <input type="radio" value="2"name="rateOption" class="rateOption"/>
                    <img src="start_uncheck.png" class="rateImg">
                </label>
                <label>
                    <input type="radio" value="3"name="rateOption" class="rateOption"/>
                    <img src="start_uncheck.png" class="rateImg">
                </label>
                <label>
                    <input type="radio" value="4"name="rateOption" class="rateOption" />
                    <img src="start_uncheck.png" class="rateImg">
                </label>
                <label>
                    <input type="radio" value="5"name="rateOption" class="rateOption"  />

                    <img src="start_uncheck.png" class="rateImg">
                </label>
            </div>

            <form  method="POST" id="serviceCommentForm">

                <div class="form-group" >
                    <big  class="form-text text-white ">Email :</big>

                    <?php
                    if (isset($_SESSION['logInCustomer'])) {
                        ?>
                        <input id = "email" name = "email" class = "form-control form-control-lg" type = "text" value ="<?php echo $_SESSION['logInCustomer']['email']; ?>" disabled>
                        <?php
                    } else {
                        ?>
                        <input id = "email" name = "email" class = "form-control form-control-lg" type = "text" placeholder = "Please enter your email.">
                        <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label class="form-text text-white">Comment :</label>
                    <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
                </div>

                <big class="form-text form-check-inline text-muted"></big>

                <input  name="ratingStar" value="0" type="hidden" id="ratingStar"/>
                <div class="buttonPosition col-md-12 ml-12 m-1">
                    <button  type="submit" form="serviceCommentForm" class="buttonStyle btn btn-primary btn-block col-md-7 ml-auto mr-auto rounded-pill" id="formSubmitBtn">Submit</button>
                </div>
            </form>
        </div>
        <script src="https://smtpjs.com/v3/smtp.js"></script>

        <?php
        include '../nav_bar/footer.php';
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            $("#serviceCommentForm").on("submit", function (e) {
                e.preventDefault();
                $.ajax({
                    url: "insertServiceComment.php",
                    type: "POST",
                    data: {
                        "action": "insertCommentFunc",
                        "data": JSON.stringify(
                                {
                                    "comment": $("#comment").val(),
                                    "ratingStar": $("#ratingStar").val()
                                }
                        )
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    }
                    ,
                    success: function (result, status, xhr) {
                        sendEmail();
                    }
                });
            })

        </script>
        <script>
            function sendEmail() {
                Email.send({
                    Host: "smtp.gmail.com",
                    Username: "teezx-wm19@student.tarc.edu.my",
                    Password: "sgxdjzbeaiqqvgim",
                    To: 'teezx-wm19@student.tarc.edu.my',
                    From: document.getElementById("email").value,
                    Subject: "Service Comment From Customer",
                    Body: "<br> Email : " + document.getElementById("email").value
                            + "<br> Comment : " + document.getElementById("comment").value
                            + "<br> Rate : " + document.getElementById("ratingStar").value

//                            Body: "Customer ID : " + document.getElementById("customer_ID").value
////                            + "<br>Name : " + document.getElementById("customer_name").value
//                             "<br> Email : " + document.getElementById("email").value
////                            + "<br> Contact Number : " + document.getElementById("contact_number").value
//                            + "<br> Comment : " + document.getElementById("comment").value
//                            //+"<br> Rate : " + document.getElementById("comment").value
                }).then(
                        message => alert("Message Sent Successfully")
                );
            }
        </script>
        <script>
            function EnableDisableTB() {
                var realName = document.getElementById("realName");
                var otherlan = document.getElementById("customer_name");
                otherlan.disabled = realName.checked ? false : true;
                otherlan.value = "";
                if (!otherlan.disabled) {
                    otherlan.focus();
                } else {
                    otherlan.value = "Anonymous";
                }
            }
        </script>

        <script>
            $(".rateOption").on('click', function (e) {
                $("#ratingStar").attr("value", $(this).val());

                $(".rateImg").each(function () {//refresh all img to uncheck first
                    $(this).attr("src", "start_uncheck.png");
                })

                $(".rateImg").each(function (index, obj) {
                    if (index < $("#ratingStar").val()) {
                        $(this).attr("src", "start_check.png");
                    }
                })
            });
        </script>
    </body>
</html>
