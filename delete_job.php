<?php

require 'conn.php';
$id = $_GET['j_id'];
$sql = "DELETE FROM jobs WHERE j_id='$id'";

if (mysqli_query($conn, $sql)) {
    echo "<script> window.location.href='job_list.php'; </script>";
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>