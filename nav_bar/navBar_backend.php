<?php

session_start();
include '../db_connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "unassignCustSESSIONFunc") {
        logCustomerIn();
        unassignCustSESSION();
    }
}

function unassignCustSESSION() {
    unset($_SESSION['logInCustomer']);
}

function logCustomerIn() {
    $conn = OpenCon();

    $sql = "update log set out_date_time = ?,date_modified = ? where cust_id = ?";

    $currentDate = date("Y-m-d H:i:s");

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $currentDate, $currentDate, $_SESSION['logInCustomer']['cust_id']);
    $stmt->execute();

    CloseCon($conn);
}
