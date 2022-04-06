<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../db_connection.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == "insertNewRegisterCustFunc") {
        insertNewRegisterCust($_POST['custDtls']);
    }
    if ($_POST['action'] == "checkUniqueEmailFunc") {
        checkUniqueEmail($_POST['email']);
    }
}

function generateCustID() {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT cust_id FROM customer ORDER BY cust_id DESC limit 1");
    //$stmt->bind_param('s', $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_object();

    $newCustID = "";
    if (!is_null($value)) {
        $latestCustID = $value->cust_id;
        $latestCustIDNum = substr($latestCustID, 1);

        $newCustID = "C" . ($latestCustIDNum + 1);
    } else {
        $newCustID = "C10001";
    }

    CloseCon($conn);

    return $newCustID;
}

function checkUniqueEmail($email) {
    $conn = OpenCon();
    $stmt = $conn->prepare("SELECT email FROM CUSTOMER where email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $value = $result->fetch_object();
    if (!is_null($value)) {
        echo "1";
    } else {
        echo "0";
    }
}

function insertNewRegisterCust($custDetails) {
    $custDetails = json_decode($custDetails, true);

    if (!is_null($custDetails)) {


        $newCustID = generateCustID();
        $conn = OpenCon();
        $sql = "INSERT INTO "
                . "CUSTOMER"
                . "(cust_id, "
                . "cust_name,"
                . "email,"
                . "password,"
                . "customer_image,"
                . "phone_no,"
                . "date_modified)"
                . "VALUES (?,?,?,?,?,?,?);";

        $currentDate = date("Y-m-d H:i:s");
        $stmt = $conn->prepare($sql);

        $custImg = file_get_contents($custDetails['cust_img']);
        $stmt->bind_param("sssssss", $newCustID, $custDetails['user_name'], $custDetails['email'], $custDetails['pass'], $custImg, $custDetails['phone'], $currentDate);
        $stmt->execute();
        CloseCon($conn);

        echo "true";
    }
}
