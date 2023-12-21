<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


if ($_SESSION['role'] != 'admin') {
   
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $goodsId = $_GET['id'];

    $sql = "SELECT * FROM goods WHERE id = $goodsId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $goodsItem = $result->fetch_assoc();
    } else {
        echo "Goods not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if (isset($_GET['delete'])) {
    $deleteSql = "DELETE FROM goods WHERE id = $goodsId";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Goods deleted successfully!";
    } else {
        echo "Error deleting goods: " . $conn->error;
    }
}
?>


