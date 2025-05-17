<?php
    require_once(SITE_ROOT . "/models/blog.php");

    $blog_posts_fetch = new Blog($db_conn);
    $blog_data = $blog_posts_fetch->getLimitedPosts(3);
?>
<section class="recent-blog-posts">
    <div class="container">
        <h2>RECENT POSTS</h2>
        <div class="blog-posts">
            <?php
                if($blog_data->num_rows != 0) {
                    while($row = $blog_data->fetch_assoc()) {
                        echo '
                            <article>
                                <a href="/blog_post.php?title=' . htmlspecialchars($row["slug_title"]) . '">
                                    <figure>
                                        <img src="'. htmlspecialchars($row["image_url"]) .'" alt="' . htmlspecialchars($row["title"]) . '">
                                        <div class="overlay">
                                            <span>Read More</span>
                                        </div>
                                        <figcaption>' . htmlspecialchars($row["title"]) . '</figcaption>
                                    </figure>
                                    <h3>' . htmlspecialchars($row["title"]) . '</h3>
                                    <p>' . htmlspecialchars($row["short_description"]) . '</p>
                                </a>
                            </article>
                        ';
                    }
                } else {
                    echo '<div class="no-posts">No posts available.</div>';
                }
            ?>
        </div>
    </div>
</section>