
<?php
session_start();
?>
<!-- Required meta tags -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

    @media screen and (max-width: 600px) and (max-width:978px){
        .pl-3{
            padding-left:auto;
        }
    }

    /* width */
    ::-webkit-scrollbar {
        width: 2px;
        margin-left: 30px;
        float: left;
        height: 4px;
        background: #fff;
        overflow-y: scroll;
        margin-bottom: 25px;
        border-radius:5px;
        background-color: yellow;
    }

    /* Track */
    ::-webkit-scrollbar-track { /*whole scroll bar*/

        background-color: rgb(16,27,44);
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: rgb(0,123,255);
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: white;
    }
    @media screen and (max-width: 992px){
        .scrolling-wrapper {    overflow: hidden;  white-space: nowrap;}

    }
</style>

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
                <a class="nav-link active  mt-lg-1 mt-sm-3 mt-3 text-lg-center  pl-2 pl-lg-0" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item mr-lg col-lg ">
                <a class="nav-link   mt-lg-1 mt-sm-3 mt-3 text-lg-center pl-2 pl-lg-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item mr-lg col-lg ">
                <a class="nav-link    mt-lg-1 mt-sm-3 mt-3 text-lg-center pl-2 pl-lg-0" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
            </li>

        </ul>
        <div class="col-lg-3 col-sm-6 align-self-lg-end float-lg-right" >
            <button type="button" id="log-in-btn" class=" btn btn-light float-lg-right  mt-lg-0 mt-sm-3 mt-3 col-sm-4 col-4 d-sm-block ">
                <?php
                if (isset($_SESSION['logInCustomer'])) {
                    echo "LOG OUT";
                } else {
                    echo "LOG IN";
                }
                ?>
            </button>
        </div>
    </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
    $("#log-in-btn").on('click', function (e) {
        if ($("#log-in-btn").text().trim() == "LOG OUT") {
            $.ajax({
                type: "POST",
                url: "http://localhost/LGTL_Cineplex/LGTL_cinema/nav_bar/navBar_backend.php",
                data: {
                    "action": "unassignCustSESSIONFunc"
                },
                error: function (xhr, status, error) {
                    console.log("Error: " + error);
                },
                success: function (result, status, xhr) {
                    alert("you have been logged out");
                    window.location.href = "http://localhost/LGTL_Cineplex/LGTL_cinema/home_page/home_page.php";

                }
            });
        } else {
            window.location.href = "http://localhost/LGTL_Cineplex/LGTL_cinema/log_in/login_form.php";
        }
    })
</script>


