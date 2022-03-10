<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>LGTL Cineplex - Log In</title>
        <meta name="viewport" content "width=device-width, initial-scale=1">
        <link rel="stylesheet" href="login_form.css">
        <!-- Bootstrap CSS library -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        
        <style>
            body{
                background-color: rgb(16,27,44);
                width: 100%;
                height: 100vh;
            }
            
            .form-container{
                padding:50px 60px;
                margin-top: 20vh;
                -webkit-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
                -moz-box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
                box-shadow: -1px 4px 26px 11px rgba(0,0,0,0.75);
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form class="form-container bg-dark text-white">
                        <h1>Welcome back!</h1>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Input your email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Input your password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    </form>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
            </div>
        </div>
    </body>
</html>
