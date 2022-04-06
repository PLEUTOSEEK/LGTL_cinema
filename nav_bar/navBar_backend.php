<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!empty($_POST['action'])) {
    if ($_POST['action'] == "unassignCustSESSIONFunc") {
        unassignCustSESSION();
    }
}

function unassignCustSESSION() {
    unset($_SESSION['logInCustomer']);
}
