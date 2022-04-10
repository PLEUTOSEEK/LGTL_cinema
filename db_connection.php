

<?php

function OpenCon() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "1234";
    $db = "lgtl_cinema";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

function CloseCon($conn) {
    $conn->close();
}

function RefreshCon($conn) {
    mysqli_refresh($conn, MYSQLI_REFRESH_GRANT);
    mysqli_refresh($conn, MYSQLI_REFRESH_LOG);
    mysqli_refresh($conn, MYSQLI_REFRESH_TABLES);
    mysqli_refresh($conn, MYSQLI_REFRESH_HOSTS);
    mysqli_refresh($conn, MYSQLI_REFRESH_STATUS);
    mysqli_refresh($conn, MYSQLI_REFRESH_THREADS);
    mysqli_refresh($conn, MYSQLI_REFRESH_SLAVE);
    mysqli_refresh($conn, MYSQLI_REFRESH_MASTER);
}
?>