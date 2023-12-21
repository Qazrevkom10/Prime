<?php
include('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            if ($row['banned']) {
                echo "You are banned";
            } else {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['role'] = $row['role'];

                // alert
                header("Location: index.php?login_success=true");
            }
        } else {
            echo "<div class='alert alert-danger'>Неверный пароль</div>";
        }
    } else {
        echo "User not found";
    }
}

if(isset($_GET['registration_success'])){
    echo "<div class='alert alert-success'>Вы успешно зарегистрировались</div>";
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>
<body>
<?php include 'navbar.php' ?>
<style>
        
        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
<h2>Login</h2>


<form action="" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" name="login" value="Login">
    <a href="register.php">Регистрация</a>

    <a href="forgot_password.php" style="margin-left: 35px;">Забыли пароль?</a>
</form>
</body>
</html>