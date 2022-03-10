<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact Us</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style> 
        /* HIDE RADIO */
        .rateOption{
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
        }
        
        .rateOptionBox{
            text-align: center;
        }
        
        button{
            text-align: center;
        }
        
        .buttonPosition{
            text-align: center;
        }
        
        input[type="radio"] {
        -ms-transform: scale(1.5); /* IE 9 */
        -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
        transform: scale(1.5);
        }
    </style>
        
    </head>
    <body>
        
        <?php
        include '../nav_bar/navigation_bar.php';
        //include 'connection.php';
        ?>
        
        <div class="container-fluid justify-content-center col-md-8">
            <form>
                <div class="form-group">
                    <big id="customer_ID" class="form-text text-muted">Customer ID :</big>
                    <input class="form-control form-control-lg" type="text" placeholder="Customer ID">
                </div>
                
                <big class="form-text text-muted form-check-inline">Status :</big>
                    <div class="form-check form-check-inline form-text text-muted col-md-4 text-center">
                    <input class="form-check-input" type="radio" name="statusOption" id="anonymous">
                    <label class="form-check-label w-100 p-3 form-check-label">Anonymous</label>
                </div>
                <div class="form-check form-check-inline form-text text-muted col-md-4 text-center">
                    <input class="form-check-input" type="radio" name="statusOption" id="realName">
                    <label class="form-check-label w-100 p-3">Real Name</label>
                </div>
                
                <div class="form-group">
                    <big id="customer_ID" class="form-text text-muted">Name :</big>
                    <input class="form-control form-control-lg" type="text" placeholder="*Optional">
                </div>
                
                <div class="form-group">
                    <big id="contact_number" class="form-text text-muted">Contact Number :</big>
                    <input class="form-control form-control-lg" type="number" placeholder="*Optional (e.g.0142227837)">
                </div>
                
                <div class="form-group">
                    <label class="form-text text-muted">Comment :</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
                
                <big class="form-text form-check-inline text-muted">Rating :</big>
                <div class="rateOptionBox">
                <label>
                    <input type="radio" name="rateOption"id="rateOption1" class="rateOption">
                    <img src="start_uncheck.png">
                </label>
                <label>
                    <input type="radio" name="rateOption"id="rateOption2" class="rateOption">
                    <img src="start_uncheck.png">
                </label>
                <label>
                    <input type="radio" name="rateOption"id="rateOption3" class="rateOption">
                    <img src="start_uncheck.png">
                </label>
                <label>
                    <input type="radio" name="rateOption"id="rateOption4" class="rateOption">
                    <img src="start_uncheck.png">
                </label>
                <label>
                    <input type="radio" name="rateOption"id="rateOption5" class="rateOption">
                    <img src="start_uncheck.png">
                </label>
                </div>
               <div class="buttonPosition">
                <button type="submit" class="btn btn-primary btn-primary btn-lg">Submit</button>
               </div>
            </form>
        </div>

        <?php
        include '../nav_bar/footer.php';
        ?>
        
    </body>
</html>
