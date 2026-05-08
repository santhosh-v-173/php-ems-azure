<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $conn = mysqli_connect(
        getenv("DB_HOST"),
        getenv("DB_USER"),
        getenv("DB_PASS"),
        getenv("DB_NAME"),
        getenv("DB_PORT")
    );

    echo "DB CONNECTED";

} catch (Exception $e) {

    die("MYSQL ERROR: " . $e->getMessage());
}

?>