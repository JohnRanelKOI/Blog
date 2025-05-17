<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="blog">
        <div class="container">
            <h2>BLOG</h2>
            <p>EVERYTHING YOU WANT TO KNOW</p>
            <div class="filters">
                <button data-filter="all">ALL</button>
                <button data-filter="becoming">BECOMING</button>
                <button data-filter="wanderlust">WANDERLUST</button>
                <button data-filter="moments">MOMENTS</button>
                <button data-filter="style">STYLE</button>
            </div>
            <input type="text" name="search" placeholder="Enter a keyword">
            <div class="blog-posts">
                
            </div>
            <div class="more-blogs" data-skip="6" data-limit="6">Load more</div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>