<?php
include('header.php');
include('dbcun.php');

$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']); 
    
    $query = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

if (isset($_POST['update_students'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']); 
    $fname = mysqli_real_escape_string($connection, $_POST['f_name']);
    $lname = mysqli_real_escape_string($connection, $_POST['l_name']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);

    $query = "UPDATE students SET first_name = '$fname', last_name = '$lname', age = '$age' WHERE id = $id";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    } else {
        header('location: index.php?update_msg=Your data has been updated successfully');
        exit;
    }
}
?>

<form action="update_page_1.php?id=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="f_name">First Name</label>
        <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>">
    </div>
    <div class="form-group">
        <label for="l_name">Last Name</label>
        <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>">
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" class="form-control" value="<?php echo $row['age'] ?>">
    </div>
    <input type="submit" class="btn btn-success" name="update_students" value="UPDATE">
</form>

<?php include('footer.php'); ?>
