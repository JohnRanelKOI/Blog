<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/ootd.php");

    $ootd_posts_fetch = new Ootd($db_conn);
    $ootd_data = $ootd_posts_fetch->getLimitedPosts(8);

    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="ootd">
        <div class="container">
            <h2>OOTD</h2>
            <p>FASHION GALLERY GUIDE</p>
            <div class="filters">
                <button data-filter="all">ALL</button>
                <button data-filter="spring">SPRING</button>
                <button data-filter="summer">SUMMER</button>
                <button data-filter="winter">WINTER</button>
                <button data-filter="fall">FALL</button>
            </div>
            <div class="ootd-posts">
                
            </div>
            <div class="more-ootds" data-skip="6" data-limit="6">Load more</div>
            <div class="image-preview" role="dialog" aria-modal="true">
                <div class="container">
                    <button><img src="./assets/images/flex/close-white.png" alt="Close image preview"></button>
                    <img class="preview-image" src="" alt="">
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>