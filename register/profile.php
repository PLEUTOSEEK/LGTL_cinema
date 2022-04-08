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

        <!-- font awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

        <!-- login form CSS -->
        <link rel="stylesheet" href="profile.css?v=<?php echo time(); ?>">

        <title>LGTL Cineplex - Profile</title>
    </head>
    <body>

        <?php
        include '../nav_bar/navigation_bar.php';
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

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
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Username</label><input type="text" id="user-name" class="form-control editable-input" value="<?php echo $_SESSION['logInCustomer']['cust_name'] ?>" disabled="true"></div>
                            <div class="col-md-12"><label class="labels">PhoneNumber</label><input type="tel" id="phone-number" class="form-control editable-input" value="<?php echo $_SESSION['logInCustomer']['phone_no'] ?>" disabled="true"></div>
                            <div class="col-md-12"><label class="labels">Email</label><input type="email" id = "email" class="form-control editable-input" value="<?php echo $_SESSION['logInCustomer']['email'] ?>" disabled="true"></div>
                            <div class="col-md-12"><label class="labels">Password</label>
                                <div class="row">
                                    <input type="password" id="password" class="pw form-control col-9 ms-3 editable-input" value="<?php echo $_SESSION['logInCustomer']['password'] ?>" disabled="true">
                                    <button class="btn bg-white text-muted col-2 ms-2 show-hide-btn editable-input" onclick="password_show_hide();" disabled="true">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
<<<<<<< HEAD

=======
>>>>>>> d74434fa2eac196ccf27f7ea37d72bc9bb828137
                        <div class="row px-3">
                            <div class="mt-5 text-left" id = "show-up-conditional" style="visibility: hidden;"><button id = "cancel-btn" class="btn btn-primary profile-button" type="button">Cancel Edit</button></div>
                            <div class="ml-auto mt-5 text-right"><button id = "edit-btn" class="btn btn-primary profile-button" type="button">Edit Profile</button></div>
                        </div>
<<<<<<< HEAD

=======
>>>>>>> d74434fa2eac196ccf27f7ea37d72bc9bb828137
                    </div>
                    <hr style="background: white">
                    <div class="my-4 text-center"><button class="btn btn-primary profile-button" id = "view-order-btn" type="button">View My Order</button></div>
                </div>
            </div>
        </div>

        <script>
            $('#OpenImgUpload').click(function () {
                $('#imgupload').trigger('click');

            });


            $("#imgupload").change(function () {
                readURL(this);
            });

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

            $("#edit-btn").on('click', function (e) {
                var self = $(this);
                if (self.text().toUpperCase() == "EDIT PROFILE") {
                    $(".editable-input").removeAttr('disabled');
                    $("#show-up-conditional").css('visibility', 'visible');
                    self.text("Save Profile");
                } else {
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
