<?php
include('dbcun.php');

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($connection, $_GET['id']); 

    $query = "DELETE FROM students WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($connection));
    } else {
        header('Location: index.php?delete_msg=You have deleted the record.');
        exit;
    }
}

mysqli_close($connection);
?>
