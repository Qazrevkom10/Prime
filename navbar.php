<?php include 'head.php'; 



include 'db.php';

$categories = getCategories();

?>




    
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#">Prime Palace</a>
        </div>
        <div class="humberger__menu__cart">
        <?php if(isset($_SESSION['user_id'])): ?>
            <ul>
                <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo count(getCart($_SESSION['user_id'])) ?></span></a></li>
            </ul>
            <?php endif; ?>
        </div>
        <div class="humberger__menu__widget">
            <?php if(isset($_SESSION['user_id'])): ?>
                            <div class="header__top__right__auth">
                                <a href="profile.php"><i class="fa fa-user"></i> Профиль</a>
                            </div>
                            <?php endif; ?>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
        <ul>
                            <li class="active"><a href="index.php">Главная</a></li>
                            <li><a href="#">Категории</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Все товары</a></li>
                                    <?php foreach($categories as $category): ?>
                                    <li><a href="./shop-details.html"><?php echo $category['name'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
    </div>
  
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                            <?php if(isset($_SESSION['user_id'])): ?>

                                <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'moderator'): ?>
                                <div class="header__top__right__auth">
                                <a href="admin.php"><i class="fa fa-user"></i>Админ панель</a>
                            </div>
                                <?php endif; ?>
                            
                            <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <?php if(isset($_SESSION['user_id'])): ?>
                            <div class="header__top__right__auth">
                                <a href="profile.php"><i class="fa fa-user"></i> Профиль</a>
                            </div>
                            <?php else: ?>
                            <div class="header__top__right__auth">
                                <a href="login.php"><i class="fa fa-user"></i> Войти</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="index.php"><h2 style="font-weight: bold; display:flex; align-items:center;"> <img style="width: 50px; margin-right:10px" src="img/logo.webp" alt=""> Prime</h2></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="index.php">Главная</a></li>
                            <li><a href="shop.php">Магазин</a></li>

                            <?php if(isset($_SESSION['user_id'])): ?>

                            <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'moderator'): ?>
                                <li><a href="add.php">Добавить</a></li>
                            <?php endif; ?>

                            <?php endif; ?>

                            <li><a href="#">Категории</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="index.php">Все товары</a></li>
                                    <?php foreach($categories as $category): ?>
                                    <li><a href="shop.php?category=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <ul>
                            <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span><?php echo count(getCart($_SESSION['user_id'])) ?></span></a></li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>