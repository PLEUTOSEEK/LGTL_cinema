<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            /*outline: 2px solid #f00;*/
            background-image: url(start_check.png);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .rateOptionBox{
            border-color: red;
        }
           
        .rating {
            display: flex;
            margin-top: -10px;
            flex-direction: row-reverse;
            margin-left: -4px;
            float: left
        }
        
        .rating>label {
            position: relative;
            width: 19px;
            font-size: 25px;
            color: #ff0000;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>input {
            display: none
        }
        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }
    </style>
    </head>
    <body>
        <?php
        include '../nav_bar/navigation_bar.php';
        //include 'connection.php';
        ?>
        
<!--        add comment section-->
        <div class="container-fluid justify-content-center col-md-7 text-muted">
            <form method="POST" id="serviceCommentForm">
         <div class="comment-box ml-12 justify-content-center float-left col-11 m-3">
             <div class="m-2 mt-2 md-9 float-left"> <img src="https://i.imgur.com/xELPaag.jpg" width="45"class="rounded-circle"> </div>
             <div class="m-3 justify-content-center text-white"><h4>Gan Wei Han</h4></div>
            <div class="col-9 float-left"> 
            <div class="rateOptionBox">
                    <label>
                        <input type="radio" name="rateOption1"id="rateOption1" class="rateOption"/>
                        <img src="start_uncheck.png" width="30%">
                    </label>
                    <label>
                        <input type="radio" name="rateOption2"id="rateOption2" class="rateOption"/>
                        <img src="start_uncheck.png" width="30%">
                    </label>
                    <label>
                        <input type="radio" name="rateOption3"id="rateOption3" class="rateOption"/>
                        <img src="start_uncheck.png" width="30%">
                    </label>
                    <label>
                        <input type="radio" name="rateOption4"id="rateOption4" class="rateOption" />
                        <img src="start_uncheck.png" width="30%">
                    </label>
                    <label>
                        <input type="radio" name="rateOption5"id="rateOption5" class="rateOption"  />
                        <img src="start_uncheck.png" width="30%">
                    </label>
            </div>
            </div>
                 <fieldset class="float-left col-12">
                <div class="comment-area"> <textarea class="form-control" placeholder="Type your comment here" id="comment"name="comment"></textarea> </div>
                 </fieldset>
            </div>
                <input  name="ratingStar" value="1" type='hidden' id="ratingStar"/>
            <div class="col-11">
            <button type="submit" form="serviceCommentForm" class="buttonStyle btn btn-primary btn-block col-3 float-right"id="commentBtn"name="commentBtn">Comment</button>
            </div>
            </form>
            
        </div>
         <?php
        include 'viewMovieComment.php';
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        
       <script>
                        $("#serviceCommentForm").on("submit", function (e) {
                            e.preventDefault();
                            $.ajax({
                                url: "insertMovieComment.php",
                                type: "POST",
                                data: {
                                    "comment": $("#comment").val(),
                                    "ratingStar": $("#ratingStar").val()
                                },
                                error: function (xhr, status, error) {
                                    console.log("Error: " + error);
                                }
                                ,
                                success: function (result, status, xhr) {
                                    alert("Comment added");
                                    console.log("success added ");
                                    location.reload();
                                }
                            });
                        });

        </script>
        
        <script>
            $(".rateOption").on('click', function (e) {
                var rateOption1 = document.getElementById("rateOption1");
                var rateOption2 = document.getElementById("rateOption2");
                var rateOption3 = document.getElementById("rateOption3");
                var rateOption4 = document.getElementById("rateOption4");
                var rateOption5 = document.getElementById("rateOption5");
                var rating = document.getElementById("ratingStar");
                if (rateOption1.checked) {
                    rating.value = "1";
                    rateOption2.checked=false ;
                    rateOption3.checked=false;
                    rateOption4.checked=false;
                    rateOption5.checked=false;
                    
                    
                } else if (rateOption2.checked) {
                    rating.value = "2";
                    rateOption1.checked=true;
                    rateOption3.checked=false;
                    rateOption4.checked=false;
                    rateOption5.checked=false;
                } else if (rateOption3.checked) {
                    rating.value = "3";
                    rateOption1.checked=true;
                    rateOption2.checked=true;
                    rateOption4.checked=false;
                    rateOption5.checked=false;
                } else if (rateOption4.checked) {
                    rating.value = "4";
                    rateOption1.checked=true;
                    rateOption2.checked=true;
                    rateOption3.checked=true;
                    rateOption5.checked=false;
                }else if(rateOption5.checked){
                    rating.value = "5";
                    rateOption1.checked=true;
                    rateOption2.checked=true;
                    rateOption3.checked=true;
                    rateOption4.checked=true;
                }
            });
        </script>

    </body>
</html>
