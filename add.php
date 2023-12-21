<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'moderator') {
    echo "У вас нет прав доступа к этой странице.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $categoryID = $_POST['category'];
    $userID = $_SESSION['user_id'];

   
    $targetDirectory = "uploads/";

    $uniqueDirectory = uniqid('goods_', true);
    $targetDirectory .= $uniqueDirectory . '/';

    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $uniqueFileName = uniqid('image_', true) . '.' . $extension;
    $targetFile = $targetDirectory . $uniqueFileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        
        $sqlInsert = "INSERT INTO goods (name, price, category_id, image, user_id) VALUES ('$productName', $productPrice, $categoryID, '$targetFile', '$userID')";

        if ($conn->query($sqlInsert) === TRUE) {
            header("Location: shop.php?good_added=true");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sqlInsert . "<br>" . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <?php include 'navbar.php'; ?>
        
    
        <div class="container">
            <div class="mt-4">
                <h2>Добавить товар</h2>
            </div>
            
            <form class="col-sm-6" action="add.php" method="post" enctype="multipart/form-data">
                <div class="mt-2">
                <label for="name">Name:</label>
                <input class="form-control" type="text" name="name" required><br>
                </div>

               <div class="mt-2">
               <label for="price">Price:</label>
                <input class="form-control" type="number" name="price" step="0.01" required><br>
               </div>

                <div class="mt-2">
                <label for="category">Category:</label>
                <select class="form-control" name="category" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="mt-2">
                <label for="image">Image:</label>
                <input class="form-control" type="file" name="image" accept="image/*" required><br>
                </div>

                <div class="mt-2">
                    <button class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </body>
</html>
