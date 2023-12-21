<?php
include 'db.php';
session_start();

$categories = getCategories();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$cart = getCart($_SESSION['user_id']);

$goods = array();

foreach($cart as $cartItem){
    $goods[] = getGoodFromCart($cartItem['good_id']);
}


if(isset($_POST['delete_cart'])){
    deleteFromCart($_SESSION['user_id'], $_POST['good_id'], $cartItem['id']);

    header("Location: cart.php?good_deleted=true");
}


if(isset($_GET['good_deleted'])){
    echo "<div class='alert alert-success'>Товар успешно удален из корзины</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
    <?php include 'navbar.php'; ?>


    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Корзина</h2>
                        </div>
                        <div class="row">
    <?php foreach($goods as $good): ?>
        <div class="col-lg-4">
            <div class="product__discount__item">
                <div class="product__discount__item__pic set-bg" data-setbg="<?php echo $good['image'] ?>">
                </div>
                <div class="product__discount__item__text">
                    <span><?php echo getGoodCategory($good['category_id'])['name'] ?></span>
                    <h5><a href="show.php?id=<?php echo $good['id'] ?>"><?php echo $good['name'] ?></a></h5>
                    <div class="product__item__price">$<?php echo $good['price'] ?> <span>$<?php echo $good['price'] + 1000 ?></span></div>

                    <form action="" method="post" class="mt-2">
                        <input type="hidden" name="good_id" value="<?php echo $good['id'] ?>">

                        <button class="btn btn-danger" name="delete_cart">Удалить с корзины</button>
                    </form>
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
