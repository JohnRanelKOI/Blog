<?php
    require_once(SITE_ROOT . "/models/ootd.php");

    $ootd_posts_fetch = new Ootd($db_conn);
    $ootd_data = $ootd_posts_fetch->getLimitedPosts(4);
    $ootd_count_data = $ootd_posts_fetch->getCount();
    $ootd_count = $ootd_count_data->fetch_assoc();
?>

<section class="ootd">
    <h2 <?php if($travel_data->num_rows === 0) echo 'style="position: relative;"'; ?>>OOTD</h2>
    <div class="container">
        <div class="ootd-container">
            <?php
                if($travel_data->num_rows !== 0) {
                    while($row = $ootd_data->fetch_assoc()) {
                        echo '
                            <figure>
                                <img src="'. htmlspecialchars($row["image_url"]) .'" alt="' . htmlspecialchars($row["title"]) . '" />
                                <figcaption>' . htmlspecialchars($row["title"]) . '</figcaption>
                            </figure>
                        ';
                    }
                } else {
                    echo '<div class="no-posts">No posts available.</div>';
                }
            ?>
        </div>
        <?php 
            if($ootd_count["count"] > 4) {
                echo '<a href="ootd.php">VIEW MORE <img src="./assets/images/flex/arrow-right.png" alt="view more arrow"/></a>';
            }
        ?>
    </div>
    <div class="image-preview" role="dialog" aria-modal="true">
        <div class="container">
            <button><img src="./assets/images/flex/close-white.png" alt="Close image preview"></button>
            <img class="preview-image" src="" alt="">
        </div>
    </div>
</section>