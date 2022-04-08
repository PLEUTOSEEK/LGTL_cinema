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

    $sql = "insert into service_comment(customer_id,rating,comment,date_modified) Values(?,?,?,?)";

                    $customer_id = !empty ($_SESSION["logInCustomer"]) ? $_SESSION["logInCustomer"] : null;
                    $comment = $_POST['comment'];
                    $rating = $_POST['ratingStar'];
                    $currentDate = date("Y-m-d H:i:s");
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss",$customer_id , $rating, $comment, $currentDate);
        $stmt->execute();      
        }
?>
