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
            if(isset($_POST['commentBtn'])){
                $movie_comment_id = "CM0001";
                $customer_id = "C0001";
                $movie_id = "MV001";
                $name = "Gan Wei Han";
                $status = "test";
                $contactNumber = 1222222;
                $rating = 1;
                $comment = $_POST['comment'];
                //$getDate = current_timestamp();
                 $dateModify = date_format($date,"U = Y-m-d H:i:s");
                
                $query ="INSERT INTO `movie_comment` (`movie_comment_id`, `customer_id`, `movie_id`, `name`, `status`, `contact_number`, `rating`, `comment`, `date_modified`) VALUES('CM0001', NULL, 'MV001', NULL, 'test', NULL, '1', '$comment',current_timestamp())";
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
