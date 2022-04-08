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
        background-image: url(../contact_us/start_check.png);
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

<div class="container-fluid">
    <!--        add comment section-->
    <?php if (isset($_SESSION['logInCustomer'])) {
        ?>
        <div class="container-fluid justify-content-center col-md-7 text-muted" id ="comment-input-section">
            <form method="POST" id="serviceCommentForm">
                <div class="comment-box ml-12 justify-content-center float-left col-11 m-3">
                    <div class="m-2 mt-2 md-9 float-left"> <img src="data:image/jpg;charset=utf8;base64,<?= $_SESSION['logInCustomer']['customer_image'] ?>" width="45"class="rounded-circle"> </div>
                    <div class="m-3 justify-content-center text-white"><h4 class ="text-uppercase"><?= $_SESSION['logInCustomer']['cust_name'] ?></h4></div>
                    <div class="col-9 float-left">
                        <div class="rateOptionBox">
                            <label>
                                <input type="radio" value="1"name="rateOption" class="rateOption"/>
                                <img src="../contact_us/start_uncheck.png" class="rateImg">
                            </label>
                            <label>
                                <input type="radio" value="2"name="rateOption" class="rateOption"/>
                                <img src="../contact_us/start_uncheck.png" class="rateImg">
                            </label>
                            <label>
                                <input type="radio" value="3"name="rateOption" class="rateOption"/>
                                <img src="../contact_us/start_uncheck.png" class="rateImg">
                            </label>
                            <label>
                                <input type="radio" value="4"name="rateOption" class="rateOption" />
                                <img src="../contact_us/start_uncheck.png" class="rateImg">
                            </label>
                            <label>
                                <input type="radio" value="5"name="rateOption" class="rateOption"  />

                                <img src="../contact_us/start_uncheck.png" class="rateImg">
                            </label>
                        </div>
                    </div>
                    <fieldset class="float-left col-12">
                        <div class="comment-area"> <textarea rows="5" class="form-control" placeholder="Type your comment here" id="comment"name="comment"></textarea> </div>
                    </fieldset>
                </div>
                <input  name="ratingStar" value="0" type='hidden' id="ratingStar"/>
                <div class="col-11">
                    <button type="submit" form="serviceCommentForm" class=" buttonStyle btn btn-primary btn-block col-3 float-right"id="commentBtn"name="commentBtn" >Comment</button>
                </div>
            </form>
        </div>
        <?php
    }
    ?>
    <div id = "viewable-comment-wrapper">

    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
    $(function () {
        $.ajax({
            url: "http://localhost/LGTL_Cineplex/LGTL_cinema/contact_us/viewMovieComment.php",
            type: "POST",
            data: {
                "action": "loadMvCommentFunc",
                "mvID": '<?php echo $mvID; ?>'
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
            ,
            success: function (result, status, xhr) {
                $("#viewable-comment-wrapper").html(result);
            }
        });
    })

    $("#serviceCommentForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "http://localhost/LGTL_Cineplex/LGTL_cinema/contact_us/insertMovieComment.php",
            type: "POST",
            data: {
                "action": "insertMovieCommentFunc",
                "data": JSON.stringify({
                    "comment": $("#comment").val(),
                    "ratingStar": $("#ratingStar").val(),
                    "mvID": '<?php echo $mvID; ?>'
                })
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
            ,
            success: function (result, status, xhr) {
                window.location.hash = '#comment-input-section';
                window.location.reload(true);
            }
        });
    });
</script>

<script>
    $(".rateOption").on('click', function (e) {
        $("#ratingStar").attr("value", $(this).val());
        $(".rateImg").each(function () {//refresh all img to uncheck first
            $(this).attr("src", "../contact_us/start_uncheck.png");
        })

        $(".rateImg").each(function (index, obj) {
            if (index < $("#ratingStar").val()) {
                $(this).attr("src", "../contact_us/start_check.png");
            }
        })
    });
</script>

