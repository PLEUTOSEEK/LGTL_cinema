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
  <body>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <div class="wrapper bg-white">
        <div class="h2 text-center">Welcome back!</div>
        <div class="h4 text-muted text-center pt-2">Enter your login details</div>
        <form class="pt-3">
            <div class="form-group py-2">
                <div class="input-field"> <span class="far fa-user p-2"></span> <input type="email" placeholder="Enter your Email Address" required class=""> </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="password" id="password" placeholder="Enter your Password" required class=""> <button class="btn bg-white text-muted" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i> </button>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="remember"> <label class="option text-muted"> Remember me <input type="checkbox" name="checkbox"> <span class="checkmark"></span> </label> </div>
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
</html>