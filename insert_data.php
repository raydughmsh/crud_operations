<?php
include('dbcun.php');

if(isset($_POST['add_students'])) {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $age = $_POST['age'];

    if (empty($fname)) {
        header('Location: index.php?message=You need to fill in the first name!');
        exit; 
    }

    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $fname = mysqli_real_escape_string($connection, $fname);
    $lname = mysqli_real_escape_string($connection, $lname);
    $age = mysqli_real_escape_string($connection, $age);

    $query = "INSERT INTO students (first_name, last_name, age) VALUES ('$fname', '$lname', '$age')";

    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        header('Location: index.php?insert_msg=Your data has been added successfully');
        exit; 
    }

    mysqli_close($connection);
}
?>
