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
  <body>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <div class="wrapper bg-white">
        <div class="h2 text-center">Sign Up</div>
        <div class="h4 text-muted text-center pt-2">Enter your account details</div>
        <form class="pt-3">
            <div class="form-group py-2">
                <div class="input-field"> <span class="fas fa-user p-2"></span> <input type="text" placeholder="Enter your Username" required class=""> </div>
            </div>
            <div class="form-group py-2">
                <div class="input-field"> <span class="fas fa-envelope p-2"></span> <input type="email" placeholder="Enter your Email Address" required class=""> </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Enter your Password" required class=""> <button class="btn bg-white text-muted" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i> </button>
                </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="password" id="retypepassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Repeat your Password" required class=""> <button class="btn bg-white text-muted" onclick="retypepassword_show_hide();">
                        <i class="fas fa-eye" id="show_eye2"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye2"></i> </button>
                </div>
            </div>
            <div id="passwordHelpBlock" class="form-text">
                Password must:<br>Contain minimum 8 characters<br>Include at least one number and symbol.<br>Include both upper and lower case letters.
            </div>
            
            <!-- Button trigger modal -->
            <div class="text-center"><button class="btn btn-danger text-center mt-3 px-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Send</button></div>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      We will be sending your LGTL OTP code to the email address, example@gmail.com.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-warning">Confirm</button>
                    </div>
                  </div>
                </div>
            </div>

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
            </div>
            
            <div class="d-flex align-items-start">
                <div class="form-text"> <label class="option text-muted"> By submitting this form, I agree to LGTL Cineplex's <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>. I hereby confirm that the information provided is accurate, complete and up-to-date. <input type="checkbox" name="checkbox"> <span class="checkmark"></span> </label> </div>
            </div > 
            <button class="btn btn-block text-center my-3 fs-5">Submit</button>
            <div class="text-center pt-3 text-muted">Already Member? <a href="#">Login here</a></div>
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
        
        document.addEventListener("DOMContentLoaded", function(event) {

        function OTPInput() {
        const inputs = document.querySelectorAll('#otp > *[id]');
        for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } OTPInput(); });
    </script>
  </body>
</html>