<?php

require 'conn.php';
$id = $_GET['e_id'];
$sql = "DELETE FROM employees WHERE e_id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "<script> window.location.href='dash.php'; </script>";
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>