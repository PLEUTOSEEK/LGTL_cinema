<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact Us</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <style>
            /* HIDE RADIO */
            .rateOption{
                position: absolute;
                opacity: 0;
                width: 0;
                height: 0;
            }

            /* IMAGE STYLES */
            [type=radio] + img {
                cursor: pointer;
            }

            /* CHECKED STYLES */
            [type=radio]:checked + img {
                /*outline: 2px solid #f00;*/
                background-image: url(start_check.png);
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
        //email or add data only can perform either one
        //cannot perform checkRate() function
        ?>

        <div class="formdesign container-fluid justify-content-center col-md-5">
            <h3 class="m-1">Service Rating</h3><br/>
            <form  method="POST" id="serviceCommentForm">
                <div class="form-group">
                    <big class="form-text text-muted">Customer ID :</big>
                    <input id="customer_ID" name ="customer_ID" class="form-control form-control-lg" type="text" placeholder="Customer ID">
                </div>

                <big class="form-text text-muted form-check-inline">Status :</big>
                <div class="form-check form-check-inline form-text text-muted col-md-4 text-center">
                    <input class="form-check-input" type="radio" name="statusOption" id="anonymous" onclick="EnableDisableTB()">
                    <label class="form-check-label w-100 p-3 form-check-label">Anonymous</label>
                </div>
                <div class="form-check form-check-inline form-text text-muted col-md-4 text-center">
                    <input class="form-check-input" type="radio" name="statusOption" id="realName" name="realName" onclick="EnableDisableTB()">
                    <label class="form-check-label w-100 p-3">Real Name</label>
                </div>

                <div class="form-group">
                    <big  class="form-text text-muted ">Name :</big>
                    <input id="customer_name" name="customer_name" class="form-control form-control-lg" type="text" placeholder="*Optional" disabled="disabled">
                </div>

                <div class="form-group">
                    <big  class="form-text text-muted ">Email :</big>
                    <input id="email" name="email" class="form-control form-control-lg" type="text" placeholder="Email">
                </div>

                <div class="form-group">
                    <big class="form-text text-muted">Contact Number :</big>
                    <input id="contact_number" name="contact_number" class="form-control form-control-lg" type="number" placeholder="*Optional (e.g.0142227837)">
                </div>

                <div class="form-group">
                    <label class="form-text text-muted">Comment :</label>
                    <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
                </div>

                <big class="form-text form-check-inline text-muted"></big>
                <div class="rateOptionBox">
                    <label>
                        <input type="radio" name="rateOption"id="rateOption1" class="rateOption" onclick="checkRate();">
                        <img src="start_uncheck.png">
                    </label>
                    <label>
                        <input type="radio" name="rateOption"id="rateOption2" class="rateOption" onclick="checkRate();">
                        <img src="start_uncheck.png">
                    </label>
                    <label>
                        <input type="radio" name="rateOption"id="rateOption3" class="rateOption" onclick="checkRate();">
                        <img src="start_uncheck.png">
                    </label>
                    <label>
                        <input type="radio" name="rateOption"id="rateOption4" class="rateOption" onclick="checkRate();">
                        <img src="start_uncheck.png">
                    </label>
                    <label>
                        <input type="radio" name="rateOption"id="rateOption5" class="rateOption" onclick="checkRate();">
                        <img src="start_uncheck.png">
                    </label>
                </div>
                <p  name="rating" id="rating123">123</p>
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
                                    data: {"submit": "submitted",
                                        "customer_ID": $("#customer_ID").val(),
                                        "customer_name": $("#customer_name").val(),
                                        "contact_number": $("#contact_number").val(),
                                        "comment": $("#comment").val()
                                    },
                                    error: function (xhr, status, error) {
                                        console.log("Error: " + error);
                                    }
                                    ,
                                    success: function (result, status, xhr) {
                                        sendEmail();
                                        reset();
                                        return false;
                                    }
                                });
                            })

        </script>
        <script>
            function sendEmail() {
                Email.send({
                    Host: "smtp.gmail.com",
                    Username: "ganwh-wm19@student.tarc.edu.my",
                    Password: "fnlobujiqbdpvwcp",
                    To: 'weihangan0@gmail.com',
                    From: document.getElementById("email").value,
                    Subject: "This is the subject",
                    Body: "Customer ID : " + document.getElementById("customer_ID").value
                            + "<br>Name : " + document.getElementById("customer_name").value
                            + "<br> Email : " + document.getElementById("email").value
                            + "<br> Contact Number : " + document.getElementById("contact_number").value
                            + "<br> Comment : " + document.getElementById("comment").value
                            //+"<br> Rate : " + document.getElementById("comment").value
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
            function checkRate() {
                var rateOption1 = document.getElementById("rateOption1");
                var rateOption2 = document.getElementById("rateOption2");
                var rateOption3 = document.getElementById("rateOption3");
                var rateOption4 = document.getElementById("rateOption4");
                var rateOption5 = document.getElementById("rateOption5");
                var rating = document.getElementById("rating123");
                rating.value = 5;
                if (rateOption1.checked) {
                    rating.value = 1;
                } else if (rateOption2.checked) {
                    rating.value = 2;
                } else if (rateOption3.checked) {
                    rating.value = 3;
                } else if (rateOption4.checked) {
                    rating.value = 4;
                }else(rateOption5.checked){
                    rating.value = 5;
                }
            }
        </script>
    </body>
</html>
