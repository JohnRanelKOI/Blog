<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
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
    <section class="recent-blog-posts">
        <div class="container">
            <h2>RECENT POSTS</h2>
            <div class="blog-posts">
                <article>
                    <a href="blog-post.html">
                        <figure>
                            <img src="./assets/images/blog/thumbnail/post1.jpg" alt="Woman embracing change">
                            <div class="overlay">
                                <span>Read More</span>
                            </div>
                            <figcaption>Woman embracing change</figcaption>
                        </figure>
                        <h3>Embracing Change: Why Life’s Uncertainties Make Us Stronger</h3>
                        <p>A personal take on adapting to life’s twists and turns.</p>
                    </a>
                </article>
                <article>
                    <a href="blog-post.html">
                        <figure>
                            <img src="./assets/images/blog/thumbnail/post2.png" alt="The view from a plane window">
                            <div class="overlay">
                                <span>Read More</span>
                            </div>
                            <figcaption>Travel plane view</figcaption>
                        </figure>
                        <h3>Wanderlust Chronicles: My Most Memorable Travel Experience</h3>
                        <p>A story about a special trip and lessons learned along the way.</p>
                    </a>
                </article>
                <article>
                    <a href="blog-post.html">
                        <figure>
                            <img src="./assets/images/blog/thumbnail/post3.jpg" alt="Wardrobe dresses ootd">
                            <div class="overlay">
                                <span>Read More</span>
                            </div>
                            <figcaption>Wardrobe staples</figcaption>
                        </figure>
                        <h3>5 Wardrobe Staples That Never Go Out of Style</h3>
                        <p>A guide to timeless fashion essentials.</p>
                    </a>
                </article>
            </div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>