<?php
$host = "localhost";
        $dbuser = "root";
        $pass = "";
        $dbname ="lgtl_cinema";
        $conn = mysqli_connect($host,$dbuser,$pass,$dbname);
        $date=date_create();
        
        
        if(mysqli_connect_error()){
            die("connection failed".mysqli_connect_error());
            echo'failure add';
        }
        else{
            echo "connected to database ($dbname)";
            
            $sql = "insert into movie_comment(customer_id,movie_id,rating,comment,date_modified) Values(?,?,?,?,?)";
            
                $movie_comment_id = 1;
                $customer_id = "C0001";
                $movie_id = "MV001";
                $rating = $_POST['ratingStar'];
                $comment = $_POST['comment'];
//                $comment ="suck";
                $currentDate = date("Y-m-d H:i:s");
                
//                $query ="INSERT INTO `movie_comment` (`customer_id`, `movie_id`, `rating`, `comment`, `date_modified`) VALUES('C0001', 'MV001', $rating, $comment, 'current_timestamp()')";
//                $run = mysqli_query($conn,$query) or die(mysqli_error($conn));
//                
//                if($run){
//                    echo "Add successfully";
//                }else{
//                    echo"Failure add";
//                }
                 
                 
                 $stmt = $conn->prepare($sql);
                 $stmt->bind_param('sssss', $customer_id,$movie_id, $rating, $comment, $currentDate);
                 $stmt->execute();  
                 
                 header("Location: comment_section.php");
        }
?>
