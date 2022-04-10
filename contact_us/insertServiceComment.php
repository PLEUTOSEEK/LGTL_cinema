<?php

session_start();

include "../db_connection.php";

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "insertCommentFunc") {
        insertComment($_POST['data']);
    }
}

function insertComment($data) {
    $data = json_decode($data, true);

    $custID = isset($_SESSION["logInCustomer"]) ? $_SESSION["logInCustomer"]['cust_id'] : "00000";
    $conn = OpenCon();
    $sql = "insert into service_comment(cust_id,rating,comment,date_modified) Values(?,?,?,?)";
    $currentDate = date("Y-m-d H:i:s");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $custID, $data['ratingStar'], $data['comment'], $currentDate);
    $stmt->execute();
    CloseCon($conn);
}

?>
