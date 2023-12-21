<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include('db.php');

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php' ?>
<body>
    <?php include 'navbar.php' ?>
    
    <div class="container">
        <h2>User Profile</h2>
        

        <div class="mt-4">
        <p>Firstname: <?php echo $user["first_name"]; ?></p>
        <p>Lastname:<?php echo $user["last_name"]; ?></p>
        <p>Phone number:<?php echo $user["phone_number"]; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Role: <?php echo $user['role']; ?></p>
        </div>

        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
