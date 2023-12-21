<?php
include 'db.php';
session_start();

if (!($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'moderator')) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['delete_category_btn'])){
    
    deleteCategory($_POST['category_id']);

}

if (isset($_POST['add_category_btn'])){
    
    addCategory($_POST['category_name']);

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
    

    <div class="main">
        <div class="container mt-4">
            <form action="" method="post" style="display:flex; gap:10px">
                <input class="form-control" style="width: 300px" type="text" name="category_name" placeholder="Название категории">
                <button class="btn btn-primary" name="add_category_btn">Добавить категорию</button>
            </form>

            <table class="table mt-4 roles_table">
            <h2>Категории</h2>
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Продукты</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sqlUsers = "SELECT * FROM categories";

                    $resultCategories = $conn->query($sqlUsers);

                    foreach($resultCategories as $category):
                    ?>
                    <tr>
                        <td><?php echo $category['name'] ?></td>
                        <!-- Products count -->
                        <td>
                            <?php
                            $sqlProducts = "SELECT COUNT(*) FROM goods WHERE category_id = " . $category['id'];
                            $resultProducts = $conn->query($sqlProducts);
                            $productsCount = $resultProducts->fetch_assoc()['COUNT(*)'];
                            echo $productsCount;
                            ?>
                        </td>
                        <td>
                            <form id="category_delete_form" action="" method="post">
                            <input type="hidden" name="category_id" value="<?php echo $category['id'] ?>">
                            <button class="btn btn-danger" name="delete_category_btn">Удалить</button>
                            </form>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <?php include 'footer.php' ?>

</body>

</html>
