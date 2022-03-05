<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>Hello, world!</title>
        <style>
            body {
                margin: 10px;
                background-color: rgb(16,27,44);
            }

            .nav-link:selected{
                background-color: #6DD4F9;
            }

            .nav-link:hover{
                background-color: #314CAA;
            }


            .btn-outline-primary:hover{
                background-color: #314CAA !important;
            }

            .btn-outline-primary:active {
                background: rgb(0,123,255) !important;
            }

            .srchBar{
                background-color : #F7F7F7 !important;
            }

            @media screen and (max-width: 600px) and (max-width:978px){
                .pl-3{
                    padding-left:auto;
                }
            }
        </style>
    </head>
    <body>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark align-items-center pr-lg-0">
            <a class="navbar-brand   " href="#">LGTL Cineplex</a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class=" collapse navbar-collapse col-lg justify-content-center pr-lg-0" id="navbarSupportedContent">
                <ul class="nav nav-pills  navbar-nav col-lg-9 " id="pills-tab" role="tablist">
                    <li class="nav-item mr-lg col-lg ">
                        <a class="nav-link active pl-sm-3 pl-3 mt-lg-1 mt-sm-3 mt-3 text-lg-center " id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item mr-lg col-lg ">
                        <a class="nav-link  pl-sm-3 pl-3 mt-lg-1 mt-sm-3 mt-3 text-lg-center" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item mr-lg col-lg ">
                        <a class="nav-link   pl-sm-3 pl-3 mt-lg-1 mt-sm-3 mt-3 text-lg-center" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                    </li>

                </ul>
                <div class="col-lg-3 col-sm-6 align-self-lg-end float-lg-right" >
                    <button type="button" class=" btn btn-light float-lg-right  mt-lg-0 mt-sm-3 mt-3 col-sm-4 col-4 d-sm-block ">
                        LOG IN
                    </button>
                </div>
            </div>
        </nav>


        <?php
        // put your code here
        ?>
    </body>
</html>
