<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="landing-banner">
        <div class="banner-picture">
            <img src="<?php echo SITE_URL; ?>/assets/images/index/banner-photo.png" alt="Jane walking">
        </div>
        <div class="banner-content">
            <div class="message">
                <h1>Welcome to <br> Life Musings by Jane</h1>
                <p>A space where everyday thoughts turn into meaningful reflections. From personal stories to life lessons, I share musings on love, growth, and the little joys that make life beautiful. Grab a cup of coffee, take a deep breath, and explore the journey with me.</p>
            </div>
        </div>
    </section>
    <?php 
        include_once(SITE_ROOT . "/includes/index/travel_section.php");
        include_once(SITE_ROOT . "/includes/index/blog_section.php");
        include_once(SITE_ROOT . "/includes/index/ootd_section.php");
    ?>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>