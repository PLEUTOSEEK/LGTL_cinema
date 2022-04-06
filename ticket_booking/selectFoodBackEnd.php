<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../db_connection.php';

function getFoods() {
    $conn = OpenCon();

    $foods = array();

    $sql = "
            SELECT
                *
            FROM
                FOOD_AND_BEVERAGE";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($food = $result->fetch_assoc()) {
            array_push($foods, $food);
        }
    } else {
        echo "0 results";
    }

    CloseCon($conn);

    return $foods;
}
