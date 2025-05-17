<?php
    include_once(SITE_ROOT . "/helpers/navigation.php");
    $navigation = new Navigation(SITE_PATH);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo strtoupper($navigation->getActivePage()) ?> | LIFE MUSINGS BY JANE</title>
        <link rel="icon" href="./assets/images/flex/favicon.ico" type="image/x-icon">
        <meta name="description" content="A space where everyday thoughts turn into meaningful reflections. From personal stories to life lessons, I share musings on love, growth, and the little joys that make life beautiful. Grab a cup of coffee, take a deep breath, and explore the journey with me.">
        <meta name="robots" content="index, follow">
        <meta property="og:title" content="LIFE MUSINGS BY JANE">
        <meta property="og:description" content="A space where everyday thoughts turn into meaningful reflections. From personal stories to life lessons, I share musings on love, growth, and the little joys that make life beautiful. Grab a cup of coffee, take a deep breath, and explore the journey with me.">
        <meta property="og:url" content="https://lifemusingsofjane.infinityfreeapp.com/">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="LIFE MUSINGS BY JANE">
        <meta name="twitter:description" content="A space where everyday thoughts turn into meaningful reflections. From personal stories to life lessons, I share musings on love, growth, and the little joys that make life beautiful. Grab a cup of coffee, take a deep breath, and explore the journey with me.">
        <link rel="canonical" href="https://lifemusingsofjane.infinityfreeapp.com/">
        <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/styles/header-footer.css" type="text/css">
        <?php
            if(strpos($navigation->getActivePage(), "admin") === false) {
                echo '<link rel="stylesheet" href="' . SITE_URL . '/assets/styles/' . $navigation->getActivePage() . '.css" type="text/css">';
            } else {
                echo '<link rel="stylesheet" href="' . SITE_URL . '/assets/styles/admin.css" type="text/css">';
            }
        ?>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/js/jquery-3.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/js/scripts.js"></script>
        <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/js/helpers/helpers.js"></script>
        <?php
            if(SITE_PATH === "/travel_post" || SITE_PATH === "/blog_post")
                echo '<script type="text/javascript" src="' . SITE_URL . '/assets/js/ajax/comments.js"></script>';
            if(SITE_PATH === "/blog")
                echo '<script type="text/javascript" src="' . SITE_URL . '/assets/js/ajax/blog-pagination.js"></script>';
            if(SITE_PATH === "/travel")
                echo '<script type="text/javascript" src="' . SITE_URL . '/assets/js/ajax/travel-pagination.js"></script>';
            if(SITE_PATH === "/ootd")
                echo '<script type="text/javascript" src="' . SITE_URL . '/assets/js/ajax/ootd-pagination.js"></script>';
            if(SITE_PATH === "/admin/blog")
                echo '<script type="text/javascript" src="' . SITE_URL . '/assets/js/ajax/blog-admin.js"></script>';
            if(SITE_PATH === "/admin/ootd")
                echo '<script type="text/javascript" src="' . SITE_URL . '/assets/js/ajax/ootd-admin.js"></script>';
            if(SITE_PATH === "/admin/travel")
                echo '<script type="text/javascript" src="' . SITE_URL . '/assets/js/ajax/travel-admin.js"></script>';
        ?>
    </head>
    <body>
    <header>
        <nav>
            <div class="container">
                <div class="logo-container">
                    <a href="index.php">
                        <img src="<?php echo SITE_URL; ?>/assets/images/nav/life_musings_of_jane_logo.png" alt="Life Musings of Jane logo">
                    </a>
                </div>
                <div class="navbar">
                    <div class="burger">
                        <span class="line-1"></span>
                        <span class="line-2"></span>
                        <span class="line-3"></span>
                    </div>
                </div>
                <div class="menu-container">
                    <button class="close-menu"><img src="<?php echo SITE_URL; ?>/assets/images/flex/close.png" alt="Close menu"></button>
                    <ul>
                        <li><a href="/index.php" <?php echo $navigation->ifPageActiveReturnClassActive("index"); ?>>HOME</a></li>
                        <li class="drop-down">
                            <a href="#">POSTS <img src="<?php echo SITE_URL; ?>/assets/images/nav/down-arrow.png" alt="Arrow down icon"></a>
                            <ul>
                                <li><a href="/travel.php" <?php echo $navigation->ifPageActiveReturnClassActive("travel"); ?>>TRAVEL</a></li>
                                <li><a href="/blog.php" <?php echo $navigation->ifPageActiveReturnClassActive("blog"); ?>>BLOG</a></li>
                                <li><a href="/ootd.php" <?php echo $navigation->ifPageActiveReturnClassActive("ootd"); ?>>OOTD</a></li>
                            </ul>
                        </li>
                        <li><a href="/about.php" <?php echo $navigation->ifPageActiveReturnClassActive("about"); ?>>ABOUT</a></li>
                        <li><a href="/contact.php" <?php echo $navigation->ifPageActiveReturnClassActive("contact"); ?>>CONTACT</a></li>
                        <?php 
                            if(!isLoggedIn()) {
                                echo "<li><a href='/login.php'" . $navigation->ifPageActiveReturnClassActive("login") . ">LOGIN</a></li>";
                                echo "<li><a href='/register.php'" . $navigation->ifPageActiveReturnClassActive("register") . ">REGISTER</a></li>";
                            } else {
                                $admin_links = "";
                                if(isUserAdmin()) {
                                    $admin_links = "<li><a href='/admin/dashboard.php'>ADMIN DASHBOARD</a></li>";
                                }
                                echo "<li class='drop-down'>
                                        <a href='/my_profile.php'" . $navigation->ifPageActiveReturnClassActive("my_profile") . ">MY PROFILE</a>
                                        <ul>
                                            " . $admin_links . "
                                            <li><a href='/controllers/login.php?logout=true'>LOGOUT</a></li>
                                        </ul>
                                    </li>
                                ";
                            }
                        ?>
                    </ul>
                    <div class="social-icons-container">
                        <a href="#"><img src="<?php echo SITE_URL; ?>/assets/images/nav/instagram.png" alt="Instagram logo"></a>
                        <a href="#"><img src="<?php echo SITE_URL; ?>/assets/images/nav/telegram.png" alt="Telegram logo"></a>
                        <a href="#"><img src="<?php echo SITE_URL; ?>/assets/images/nav/facebook.png" alt="Facebook logo"></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>