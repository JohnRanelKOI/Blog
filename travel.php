<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="travel">
        <div class="container">
            <h2>TRAVEL</h2>
            <p>A GUIDE FOR YOUR OWN JOURNEY</p>
            <div class="filters">
                <button data-filter="all">ALL</button>
                <button data-filter="cultural">CULTURAL</button>
                <button data-filter="nature">NATURE</button>
                <button data-filter="city">CITY</button>
                <button data-filter="spiritual">SPIRITUAL</button>
            </div>
            <input type="text" name="search" placeholder="Enter a keyword">
            <div class="travel-posts">

            </div>
            <div class="more-travels" data-skip="6" data-limit="6">Load more</div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>