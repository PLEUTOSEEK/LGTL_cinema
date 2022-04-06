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
            <form action="insertMovieComment.php" method="POST">
         <div class="comment-box ml-12 justify-content-center float-left col-11 m-3">
             <div class="m-2 mt-2 md-9 float-left"> <img src="https://i.imgur.com/xELPaag.jpg" width="45"class="rounded-circle"> </div>
             <div class="m-3 justify-content-center"><h4>Gan Wei Han</h4></div>
            <div class="col-5 float-left"> 
                <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div><br>
            </div>
                 <fieldset class="float-left col-12">
                <div class="comment-area"> <textarea class="form-control" placeholder="Type your comment here" id="comment"name="comment"></textarea> </div>
                 </fieldset>
            </div>
            <div class="col-11">
            <button type="submit" class="buttonStyle btn btn-primary btn-block col-3 float-right"id="commentBtn"name="commentBtn">Comment</button>
            </div>
            </form>
        </div>
        
<!--        view comment section-->
        <div class="container-fluid justify-content-center col-md-7 text-muted">
         <div class="comment-box ml-12 justify-content-center float-left col-11 m-3">
             <div class="m-2 mt-2 md-9 float-left"> <img src="https://i.imgur.com/xELPaag.jpg" width="45"class="rounded-circle"> </div>
             <div class="m-3 justify-content-center"><h4>Gan Wei Han</h4></div>
            <div class="col-5 float-left"> 
                <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div><br>
            </div>
                 <fieldset disabled class="float-left col-12">
                <div class="comment-area"> <textarea class="form-control disabledTextInput">Hello word.</textarea> </div>
                 </fieldset>
            </div>            
         </div>
        
    </body>
</html>
