<?php
include('db.php');

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    
    $sql = "INSERT INTO users (first_name, last_name, email, password, phone_number, role) VALUES ('$first_name', '$last_name', '$email', '$password', '$phone_number', 'user')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php?registration_success=true");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
    <h2>Registration</h2>
    <form class="mt-4" action="" method="post">
        <label for="first_name">First Name:</label>
        <input class="form-control" type="text" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input class="form-control" type="text" name="last_name" required><br>

        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input class="form-control" type="password" name="password" required><br>

        <label for="phone_number">Phone Number:</label>
        <input class="form-control" type="tel" name="phone_number" required><br>

        <input class="btn btn-primary" name="register" type="submit">
    </form>
</div>
</body>
</html>


