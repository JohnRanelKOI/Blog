<?php 
    include_once("../includes/global_variables.php");
    include_once("../helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/travel.php");

    $travel_posts_fetch = new Travel($db_conn);
    $table_data = $travel_posts_fetch->getLimitedPosts(10);
?>
<main>
    <div class="container">
        <?php
            include_once(SITE_ROOT . "/includes/side_menu.php");
        ?>
        <section>
            <?php include_once(SITE_ROOT . "/includes/admin/admin_tables.php") ?>
            <?php include_once(SITE_ROOT . "/includes/admin/create_update_post.php") ?>
            <?php include_once(SITE_ROOT . "/includes/admin/delete_post.php") ?>
        </section>
    </div>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php") ?>