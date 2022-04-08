<?php

session_start();
include '../db_connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['action'])) {
    if ($_POST['action'] == "validateLogInFunc") {
        validateLogIn($_POST['loginDtls']);
    }
    if ($_POST['action'] == "openCustomerSessionFunc") {
        assignCustomerSESSION($_POST['custDtls']);
    }
}

function validateLogIn($loginDtls) {
    $loginDtls = json_decode($loginDtls, true);

    if (!is_null($loginDtls)) {
        $custDtls = array();
        //comapre pass and email
        $conn = OpenCon();
        $stmt = $conn->prepare("SELECT * FROM CUSTOMER WHERE UPPER(email) = UPPER(?) AND password = ?");
        $stmt->bind_param('ss', $loginDtls['email'], $loginDtls['pass']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($custDtls, $row);
            }
        }

        CloseCon($conn);

        if (count($custDtls) != 0) {
            $custDtls[0]['customer_image'] = base64_encode($custDtls[0]['customer_image']);
            echo json_encode($custDtls[0]);
        } else {
            echo "\"null\"";
        }
    }
}

function assignCustomerSESSION($custDtls) {
    $_SESSION['logInCustomer'] = json_decode($custDtls, true);
}
