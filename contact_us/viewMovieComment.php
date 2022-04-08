<?php
        $host = "localhost";
        $dbuser = "root";
        $pass = "";
        $dbname ="lgtl_cinema";
        $conn = mysqli_connect($host,$dbuser,$pass,$dbname);
        
        $query="select * from movie_comment"; 
        $result= mysqli_query($conn,$query);
        
        if(mysqli_connect_error()){
            die("connection failed".mysqli_connect_error());
        }
        else{
        while($rows= mysqli_fetch_assoc($result)){
            echo '<div class="container-fluid justify-content-center col-md-7 text-muted">';
            echo '<div class="comment-box ml-12 justify-content-center float-left col-11 m-3">';
            echo '<div class="m-2 mt-2 md-9 float-left"> <img src="https://i.imgur.com/xELPaag.jpg" width="45"class="rounded-circle"> </div>';
            echo '<div class="m-3 justify-content-center text-white"><h4>';
            echo $rows['customer_id'];
            echo '</h4></div>';
            echo '<div class="col-9 float-left">'; 
            echo '<div class="rateOptionBox">';
            $checkRateNumber = $rows['rating'];
            checkRate($checkRateNumber);
            echo '</div>';
            echo '</div>';
            echo '<fieldset disabled class="float-left col-12">';
            echo '<div class="comment-area"> <textarea class="form-control disabledTextInput">';
            echo $rows['comment'];
            echo '</textarea> </div>';
            echo '</fieldset>';
            echo '</div>';            
            echo '</div>';
            
        }
        }
        
        function checkRate($row){
                $i=0;
                while($i<$row){
                    echo '<label>';
                    echo '<input type="radio" name="rateOption1"id="rateOption1" class="rateOption1" />';
                    echo '<img src="start_check.png" width="30%">';
                    echo '</label>';
                    $i++;
                }
            }
?>

