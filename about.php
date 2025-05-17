<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    require_once(SITE_ROOT . "/includes/config.php");
    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="about-banner">
        <div class="banner-picture">
            <img src="./assets/images/about/jane-portrait.png" alt="Jane walking">
        </div>
        <div class="banner-content">
            <div class="message">
                <h1>ABOUT ME</h1>
                <p>Hi there! I’m Jane, the heart and mind behind Jane’s Life Musings. This little corner of the internet is where I pour out my thoughts, document my adventures, and share the things that inspire me—whether it’s a stylish outfit, a breathtaking travel destination, or a simple reflection on life’s everyday moments.</p>
                <p>I believe in finding beauty in the ordinary, embracing self-growth, and capturing life’s fleeting moments through words and photographs. Whether you’re here for a dose of inspiration, fashion tips, or just a good read over coffee, I hope my musings bring a little joy and relatability to your day.</p>
            </div>
        </div>
    </section>
    <?php include_once(SITE_ROOT . "/includes/recent_posts.php"); ?>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>