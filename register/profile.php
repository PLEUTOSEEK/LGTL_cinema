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
        <br>
        <div class="container rounded mt-5 mb-5 text-white">
            <div class="row">
                <div class="col-md-5 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="avatar rounded-circle mt-5" src="./img/avatar0.png"><span class="font-weight-bold text-white"><input type="file" id="imgupload" style="display:none"/><button class="btn btn-primary mt-4" id="OpenImgUpload" disabled="">Change Avatar</button></span><span> </span></div>
                </div>
                <div class="col-md-6 border-left ps-5">
                    <div class="p-3 pt-5 pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Username</label><input type="text" class="form-control" value="" disabled="true"></div>
                            <div class="col-md-12"><label class="labels">PhoneNumber</label><input type="tel" class="form-control" value="" disabled="true"></div>
                            <div class="col-md-12"><label class="labels">Email</label><input type="email" class="form-control" value="" disabled="true"></div>
                            <div class="col-md-12"><label class="labels">Password</label>
                                <div class="row">
                                    <input type="password" id="password" class="pw form-control col-9 ms-3" value="" disabled="true">
                                    <button class="btn bg-white text-muted col-2 ms-2 show-hide-btn" onclick="password_show_hide();" disabled="true">
                                        <i class="fas fa-eye" id="show_eye"></i>
                                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i> 
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Edit Profile</button></div>
                    </div>
                    <hr style="background: white">
                    <div class="my-4 text-center"><button class="btn btn-primary profile-button" type="button">View My Order</button></div>
                </div>
            </div>
        </div>
        
        <script>
            $('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });
            
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
        
        <?php
        include '../nav_bar/footer.php';
        ?>        
    </body>
</html>
