<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['login_success'])){
    echo "<div class='alert alert-success'>Вы успешно вошли в систему</div>";
}


$sqlCategories = "SELECT * FROM categories";
$resultCategories = $conn->query($sqlCategories);

$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

$goodsList = readGoods($selectedCategory);
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
    <?php include 'navbar.php'; ?>


    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                                <div class="img-box">
                                    <img src="images/4316.jpg" alt="">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                                <div class="img-box">
                                    <img src="images/4316.jpg" alt="">
                                </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container ">
                        <div class="row">
                                <div class="img-box">
                                    <img src="images/4316.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel_btn_box">
                <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>




    <!-- <div class="container">
        <h2>Goods List</h2>

        <form action="index.php" method="get">
            <label for="category">Choose a category:</label>
            <select name="category">
                <option value="">All Categories</option>
                <?php while ($category = $resultCategories->fetch_assoc()): ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $selectedCategory) ? 'selected' : ''; ?>><?php echo $category['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Filter">
        </form>

        </div> -->

        <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container ">
                        <div class="row">
                                <div class="img-box">
                                    <img src="images/iphone13.png." alt="">
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>

    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our Products
                </h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p1.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p2.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p3.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p4.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p5.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p6.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p7.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p8.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/p9.png" alt="">
                            <a href="" class="add_cart_btn">
                <span>
                  Add To Cart
                </span>
                            </a>
                        </div>
                        <div class="detail-box">
                            <h5>
                                Product Name
                            </h5>
                            <div class="product_info">
                                <h5>
                                    <span>$</span> 300
                                </h5>
                                <div class="star_container">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn_box">
                <a href="" class="view_more-link">
                    View More
                </a>
            </div>
        </div>
    </section>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/custom.js"></script>

    <?php include 'footer.php' ?>
</body>

</html>
