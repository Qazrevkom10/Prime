<?php
include('db.php');
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $goodsId = $_POST["goods_id"]; 

    $updatedName = $_POST["updated_name"];
    $updatedPrice = $_POST["updated_price"];

    
    $targetDirectory = "uploads/";

    
    if ($_FILES["updated_image"]["size"] > 0) {
        
        $uniqueDirectory = uniqid('goods_', true);
        $targetDirectory .= $uniqueDirectory . '/';

        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        
        $extension = pathinfo($_FILES["updated_image"]["name"], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid('image_', true) . '.' . $extension;
        $targetFile = $targetDirectory . $uniqueFileName;

        
        if (move_uploaded_file($_FILES["updated_image"]["tmp_name"], $targetFile)) {
            
            $updateSql = "UPDATE goods SET name='$updatedName', price=$updatedPrice, image='$targetFile' WHERE id=$goodsId";
        } else {
            echo "<div class='alert alert-danger'>Sorry, there was an error uploading the updated file.</div>";
            exit;
        }
    } else {
        
        $updateSql = "UPDATE goods SET name='$updatedName', price=$updatedPrice WHERE id=$goodsId";
    }

    
    if ($conn->query($updateSql) === TRUE) {
        echo "<div class='alert alert-success'>Товар успешно отредактирован</div>";
    } else {
        echo "<div class='alert alert-danger'>Товар не был обновлен</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'head.php'; ?>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2>Edit Goods</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="goods_id" value="<?php echo $goodsItem['id']; ?>">
            <div class="mt-2">
            <label for="updated_name">Name:</label>
            <input class="form-control" type="text" name="updated_name" value="<?php echo $goodsItem['name']; ?>" required><br>
            </div>

            <div class="mt-2">
            <label for="updated_price">Price:</label>
            <input class="form-control" type="number" name="updated_price" value="<?php echo $goodsItem['price']; ?>" step="0.01" required><br>

            </div>
            <div class="mt-2">
            <label for="updated_image">Image URL:</label>
            <input class="form-control" type="file" name="updated_image">
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Изменить</button>
            </div>
        </form>
    </div>

</body>
</html>
