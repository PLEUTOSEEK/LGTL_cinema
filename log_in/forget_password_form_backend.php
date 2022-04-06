<?php

session_start();
include '../db_connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "checkEmailExistanceFunc") {
        checkEmailExistance($_POST['email']);
    }
}

function checkEmailExistance($email) {
    $conn = OpenCon();

    $custDtls = array();
    $stmt = $conn->prepare("SELECT * FROM CUSTOMER where UPPER(email) = UPPER(?)");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($custDtls, $row);
        }
    }

    CloseCon($conn);

    if (count($custDtls) != 0) {
        $custDtls = $custDtls[0];
        $newPass = randomPassword();

        $custDtls = array_merge($custDtls, array("newPass" => $newPass));

        updateCustomerAccountPassword($email, $newPass);

        $custDtls['customer_image'] = base64_encode($custDtls['customer_image']);
        echo json_encode($custDtls);
    } else {
        echo "\"null\"";
    }
}

function updateCustomerAccountPassword($email, $newPassword) {
    $conn = OpenCon();

    $sql = "UPDATE CUSTOMER SET "
            . "password = ? "
            . "WHERE "
            . "email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newPassword, $email);
    $stmt->execute();

    CloseCon($conn);
}

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
