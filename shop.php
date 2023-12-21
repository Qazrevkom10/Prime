<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['search_query'])){
    searchGoods($_GET['search_query']);
}

if(isset($_GET['good_deleted'])){
    echo "<div class='alert alert-success'>Товар успешно удален</div>";
}

if(isset($_GET['good_added'])){
    echo "<div class='alert alert-success'>Товар успешно добавлен</div>";
}

$sqlCategories = "SELECT * FROM categories";

$resultCategories = $conn->query($sqlCategories);

$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

if(isset($_GET['category'])){
    $goodsList = readGoods($_GET['category']);
}
else if(isset($_GET['search_query'])){
    $goodsList = searchGoods($_GET['search_query']);
}

else {
    $goodsList = readGoods();
}


if(isset($_POST['addCart'])){
    addToCart($_SESSION['user_id'], $_POST['good_id']);

    header("Location: shop.php?good_added_to_cart=true");
}

if(isset($_GET['good_added_to_cart'])){
    echo "<div class='alert alert-success'>Товар успешно добавлен в корзину</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
    <?php include 'navbar.php'; ?>


    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Все категории</span>
                        </div>
                        <ul>
                            <?php foreach($categories as $category): ?>
                            <li><a href="shop.php?category=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
                            <?php endforeach; ?>    
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="" method="get">
                                <input type="text" name="search_query" placeholder="Что вы ищете ?">
                                <button type="submit" class="site-btn">Поиск</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Продукты</h2>
                        </div>
                        <div class="row">
    <?php foreach($goodsList as $goods): ?>
        <div class="col-lg-4">
            <div class="product__discount__item">
                <div class="product__discount__item__pic set-bg" data-setbg="<?php echo $goods['image'] ?>">
                </div>
                <div class="product__discount__item__text">
                    <form action="" method="post" class="mt-2 mb-2">
                        <input type="hidden" name="good_id" value="<?php echo $goods['id'] ?>">
                        <button class="btn btn-primary" name="addCart">Добавить в корзину</button>
                    </form>
                    <span><?php echo getGoodCategory($goods['category_id'])['name'] ?></span>
                    <h5><a href="show.php?id=<?php echo $goods['id'] ?>"><?php echo $goods['name'] ?></a></h5>
                    <div class="product__item__price">$<?php echo $goods['price'] ?> <span>$<?php echo $goods['price'] + 1000 ?></span></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php include 'footer.php' ?>
</body>

</html>
