<?php
include('db.php');

if (isset($_POST['create'])) {
    
    $name = $_POST['name'];
    $price = $_POST['price'];

    
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
       
        if (createGoods($name, $price, $targetFile)) {
            echo "Goods added successfully!";
            header("Location: index.php");
        } else {
            echo "Error adding goods: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

