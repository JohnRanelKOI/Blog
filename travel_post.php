<?php 
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    require_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/travel.php");
    require_once(SITE_ROOT . "/models/comment.php");
    
    $travel_posts_init = new Travel($db_conn);
    $travel_post_data = $travel_posts_init->getPostBySlugTitle($_GET["title"]);
    $travel_post = $travel_post_data->fetch_assoc();

    $comments_init = new Comment($db_conn);
    $comments_data = $comments_init->getCommentsByPostId($travel_post["id"]);

    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="travel-post">
        <div class="container">
            <article>
                <div class="images">
                    <figure>
                        <img src="<?php echo $travel_post["image_url"]; ?>" alt="Hong kong diner">
                        <figcaption>Hong kong streets</figcaption>
                    </figure>
                </div>
                <div class="stay-at-details">
                    <h2><?php echo $travel_post["title"]; ?></h2>
                    <h3>Details</h3>
                    <ul>
                        <li><p><?php echo nl2br($travel_post["content"]);?></p></li>
                    </ul>
                    <?php include_once(SITE_ROOT . "/includes/member/comments.php"); ?>
                </div>
            </article>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>