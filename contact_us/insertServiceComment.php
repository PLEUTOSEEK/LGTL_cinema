<?php
<<<<<<< HEAD
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
=======

$host = "localhost";
$dbuser = "root";
$pass = "";
$dbname = "lgtl_cinema";
$conn = mysqli_connect($host, $dbuser, $pass, $dbname);
$date = date_create();

if (mysqli_connect_error()) {
    die("connection failed" . mysqli_connect_error());
} else {
    echo "connected to database ($dbname)";
>>>>>>> bf2a74dcac7021d5c3091ca90dfd172c9b7c675e

    $sql = "insert into service_comment(customer_id,rating,comment,date_modified) Values(?,?,?,?)";

<<<<<<< HEAD
        //date("Y-m-d H:i:s"); currrent date
        // $date=date_create("2013-03-15");
        //echo date_format($date,"Y/m/d H:i:s"); self-made date
                    $customer_id = !empty ($_SESSION["logInCustomer"]) ? $_SESSION["logInCustomer"] : null;
                    $comment = $_POST['comment'];
                    $rating = $_POST['ratingStar'];
                    $currentDate = date("Y-m-d H:i:s");
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss",$customer_id , $rating, $comment, $currentDate);
        $stmt->execute();      
        }
=======
    //date("Y-m-d H:i:s"); currrent date
    // $date=date_create("2013-03-15");
    //echo date_format($date,"Y/m/d H:i:s"); self-made date
    $customer_id = !empty($_SESSION["logInCustomer"]) ? $_SESSION["logInCustomer"]['cust_id'] : null;
    $comment = $_POST['comment'];
    $rating = $_POST['ratingStar'];
    $currentDate = date("Y-m-d H:i:s");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $customer_id, $rating, $comment, $currentDate);
    $stmt->execute();
}
>>>>>>> bf2a74dcac7021d5c3091ca90dfd172c9b7c675e
?>
