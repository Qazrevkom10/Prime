<?php
include 'db.php';
session_start();

if (!($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'moderator')) {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
    <?php include 'navbar.php'; ?>


    <div class="sidebar container">
        <div class="mt-2">
        <a class="active" href="admin.php">Главная</a>
        </div>
        <div class="mt-2">
        <a href="users.php">Пользователи</a>
        </div>
        <div class="mt-2">
        <a href="categories.php">Категории</a>
        </div>
    </div>


    <div class="main container mt-4">
        <h2>Admin Panel</h2>
    </div>


    <?php include 'footer.php' ?>
</body>

</html>
