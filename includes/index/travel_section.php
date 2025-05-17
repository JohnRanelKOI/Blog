<?php
    require_once(SITE_ROOT . "/models/travel.php");

    $travel_posts_fetch = new Travel($db_conn);
    $travel_data = $travel_posts_fetch->getLimitedPosts(6);
    $travel_count_data = $travel_posts_fetch->getCount();
    $travel_count = $travel_count_data->fetch_assoc();
?>

<section class="travel">
    <h2>TRAVEL</h2>
    <div class="travel-images">
        <?php
            $count = 0;
            while($row = $travel_data->fetch_assoc()) {
                $count++;
                echo '
                    <article>
                        <a href="/travel-post.php?title=' . htmlspecialchars($row["slug_title"]) . '">
                            <figure>
                                <img src="'. htmlspecialchars($row["image_url"]) .'" alt="' . htmlspecialchars($row["title"]) . '">
                                <figcaption>' . htmlspecialchars($row["title"]) . '</figcaption>
                            </figure>
                        </a>
                    </article>
                ';
            }
        ?>
        <?php 
            if($travel_count["count"] > 6) {
                echo '<a href="/travel.php">VIEW MORE <img src="./assets/images/flex/arrow-right.png" alt="view more arrow"/></a>';
            }
        ?>
    </div>
</section>