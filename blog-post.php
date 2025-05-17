<?php 
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    require_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/blog.php");
    require_once(SITE_ROOT . "/models/comment.php");
    
    $blog_posts_init = new Blog($db_conn);
    $blog_post_data = $blog_posts_init->getPostBySlugTitle($_GET["title"]);
    $blog_post = $blog_post_data->fetch_assoc();

    $comments_init = new Comment($db_conn);
    $comments_data = $comments_init->getCommentsByPostId($blog_post["id"]);

    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="blog-post">
        <div class="container">
            <article>
                <p><?php echo date('j M Y', strtotime($blog_post["date"])); ?></p>
                <h2><?php echo $blog_post["title"]; ?></h2>
                <figure>
                    <img src="<?php echo $blog_post["image_url"]; ?>" alt="<?php echo $blog_post["title"]; ?>">
                    <figcaption><?php echo $blog_post["title"]; ?></figcaption>
                </figure>
                <p><?php echo nl2br($blog_post["content"]); ?></p>
            </article>
            <?php include_once(SITE_ROOT . "/includes/member/comments.php"); ?>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>