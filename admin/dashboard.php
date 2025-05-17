<?php 
    include_once("../includes/global_variables.php");
    include_once("../helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");
    require_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/user.php");
    require_once(SITE_ROOT . "/models/travel.php");
    require_once(SITE_ROOT . "/models/blog.php");
    require_once(SITE_ROOT . "/models/ootd.php");
    require_once(SITE_ROOT . "/models/comment.php");

    $users_fetch = new User($db_conn);
    $users_count_data = $users_fetch->getCount();
    $users_count = $users_count_data->fetch_assoc();

    $travel_posts_fetch = new Travel($db_conn);
    $travel_count_data = $travel_posts_fetch->getCount();
    $travel_count = $travel_count_data->fetch_assoc();

    $blog_posts_fetch = new Blog($db_conn);
    $blog_count_data = $blog_posts_fetch->getCount();
    $blog_count = $blog_count_data->fetch_assoc();

    $ootd_posts_fetch = new Ootd($db_conn);
    $ootd_count_data = $ootd_posts_fetch->getCount();
    $ootd_count = $ootd_count_data->fetch_assoc();

    $comments_fetch = new Comment($db_conn);
    $comments_count_data = $comments_fetch->getCount();
    $comments_count = $comments_count_data->fetch_assoc();
?>
<main>
    <div class="container">
        <?php
            include_once(SITE_ROOT . "/includes/side_menu.php");
        ?>
        <section>
            <h1>Dashboard</h1>
            <div class="statistics">
                <div>
                    <h2>Users</h2>
                    <span><?php echo $users_count["count"]; ?></span>
                </div>
                <div>
                    <h2>Travel Posts</h2>
                    <span><?php echo $travel_count["count"]; ?></span>
                </div>
                <div>
                    <h2>Blog Posts</h2>
                    <span><?php echo $blog_count["count"]; ?></span>
                </div>
                <div>
                    <h2>OOTD Posts</h2>
                    <span><?php echo $ootd_count["count"]; ?></span>
                </div>
                <div>
                    <h2>User Comments</h2>
                    <span><?php echo $comments_count["count"]; ?></span>
                </div>
            </div>
        </section>
    </div>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php") ?>