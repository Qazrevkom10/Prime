<?php

include('db.php');



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $repeat_new_password = $_POST['repeat_new_password'];

   

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
    } else {
        
        echo "User not found.";
        exit;
    }

    
    if (!password_verify($old_password, $row['password'])) {
        echo "<div class='alert alert-danger'>Неверный пароль</div>";
    }

    if ($new_password === $repeat_new_password) {
        
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET password = '$hashed_new_password' WHERE id = $user_id";

        if ($conn->query($update_sql) === TRUE) {
            echo "<div class='alert alert-success'>Пароль успешно изменен</div>";
        } else {
            echo "<div class='alert alert-success'>Ошибка в изменении пароля: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Пароли не совпадают</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>
<body>
<?php include 'navbar.php' ?>
<div class="container">
    <h2></h2>

    <h3>Change Password</h3>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email" required>
        <label for="old_password">Old Password:</label>
        <input type="password" class="form-control" name="old_password" required> <br>
        <label for="new_password">New Password:</label>
        <input class="form-control" type="password" name="new_password" required><br>

        <label for="repeat_new_password">Repeat New Password:</label>
        <input class="form-control" type="password" name="repeat_new_password" required><br>

        <input type="submit" class="btn btn-primary" name="change_password">
    </form>
    <div class="mt-2">
    <a class="btn btn-primary" href="logout.php">Выйти</a>
    </div>

</div>
</body>
</html>
