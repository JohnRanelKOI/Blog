<?php
    require_once(SITE_ROOT . "/models/blog.php");

    $blog_posts_fetch = new Blog($db_conn);
    $blog_data = $blog_posts_fetch->getLimitedPosts(4);
    $blog_count_data = $blog_posts_fetch->getCount();
    $blog_count = $blog_count_data->fetch_assoc();
?>

<section class="blog">
    <h2>BLOG</h2>
    <p>EVERYTHING YOU WANT TO KNOW</p>
    <div class="container">
        <div class="blog-posts">
            <?php
                if($blog_data->num_rows != 0) {
                    while($row = $blog_data->fetch_assoc()) {
                        echo '
                            <article class="blog-item">
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
            <?php 
                if($blog_count["count"] > 4) {
                    echo '<a href="blog.html">VIEW MORE <img src="./assets/images/flex/arrow-right.png" alt="view more arrow"/></a>';
                }
            ?>
        </div>
    </div>
</section>