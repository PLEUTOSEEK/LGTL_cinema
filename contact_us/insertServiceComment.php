<?php
$host = "localhost";
        $dbuser = "root";
        $pass = "";
        $dbname ="lgtl_cinema";
        $conn = mysqli_connect($host,$dbuser,$pass,$dbname);
        $date=date_create();
        
        
        if(mysqli_connect_error()){
            die("connection failed".mysqli_connect_error());
        }
        else{
            echo "connected to database ($dbname)";
            if(isset($_POST['submit'])){
                $comment_id = "CM0001";
                $customer_id = $_POST['customer_ID'];
                $name = $_POST['customer_name'];
                $status = "test";
                $contactNumber = $_POST['contact_number'];
                $rating = 1;
                $comment = $_POST['comment'];
                 $dateModify = date_format($date,"U = Y-m-d H:i:s");
                
                $query ="insert into service_comment(service_comment_id,customer_id,name,status,contact_number,rating,comment,date_modified)values('$comment_id', '$customer_id', '$name', '$status', '123', '4', '$comment', '$dateModify')";
                $run = mysqli_query($conn,$query) or die(mysqli_error($conn));
                
                if($run){
                    echo "Add successfully";
                }else{
                    echo"Failure add";
                }
            }else{
                echo"Failure add";
            }
        }
?>
