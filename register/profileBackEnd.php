<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../db_connection.php";

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "updateProfileFunc") {
        updateProfile($_POST['data']);
    }
}

function updateProfile($data) {
    $data = json_decode($data, true);

    $conn = OpenCon();
    $sql = "UPDATE "
            . "CUSTOMER "
            . "SET "
            . "cust_name = ?, "
            . "email = ?, "
            . "password = ?, "
            . "phone_no = ?, "
            . "customer_image = ?, "
            . "date_modified = ? "
            . "WHERE cust_id = ?;";

    $currentDate = date("Y-m-d H:i:s");
    $stmt = $conn->prepare($sql);

    if (strpos($data['customer_image'], "data:image/jpg;charset=utf8;base64,") !== false) {
        $data['customer_image'] = base64_decode($_SESSION['logInCustomer']['customer_image']);
    } else {
        $data['customer_image'] = base64_decode(str_replace('data:image/jpeg;base64,', '', $data['customer_image']));
    }

    $stmt->bind_param("sssssss",
            $data['cust_name'],
            $data['email'],
            $data['password'],
            $data['phone_no'],
            $data['customer_image'],
            $currentDate,
            $_SESSION['logInCustomer']['cust_id']);

    $stmt->execute();
    CloseCon($conn);

    $data['customer_image'] = base64_encode($data['customer_image']);
    $data = array_merge($data, array("cust_id" => $_SESSION['logInCustomer']['cust_id']));

    unset($_SESSION['logInCustomer']);
    $_SESSION['logInCustomer'] = $data;
    echo "done";
}
