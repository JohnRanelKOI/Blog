        <footer>
            <div class="container">
                <div class="footer-container">
                    <div class="logo-container">
                        <a href="index.php">
                            <img src="<?php echo SITE_URL; ?>/assets/images/footer/life_musings_of_jane_logo.png" alt="Life Musings of Jane logo">
                        </a>
                    </div>
                    <div class="menu-container">
                        <a href="/index.php" <?php echo $navigation->ifPageActiveReturnClassActive("index"); ?>>HOME</a>
                        <a href="/travel.php" <?php echo $navigation->ifPageActiveReturnClassActive("travel"); ?>>TRAVEL</a>
                        <a href="/blog.php" <?php echo $navigation->ifPageActiveReturnClassActive("blog"); ?>>BLOG</a>
                        <a href="/ootd.php" <?php echo $navigation->ifPageActiveReturnClassActive("ootd"); ?>>OOTD</a>
                        <a href="/about.php" <?php echo $navigation->ifPageActiveReturnClassActive("about"); ?>>ABOUT</a>
                        <a href="/contact.php" <?php echo $navigation->ifPageActiveReturnClassActive("contact"); ?>>CONTACT</a>
                    </div>
                    <hr>
                    <div class="socials-container">
                        <p>FOLLOW ME ON MY SOCIALS</p>
                        <a href="#"><img src="<?php echo SITE_URL; ?>/assets/images/footer/instagram.png" alt="Instagram logo"></a>
                        <a href="#"><img src="<?php echo SITE_URL; ?>/assets/images/footer/telegram.png" alt="Telegram logo"></a>
                        <a href="#"><img src="<?php echo SITE_URL; ?>/assets/images/footer/facebook.png" alt="Facebook logo"></a>
                    </div>
                    <div class="copyright-container">
                        <p>COPYRIGHT 2025 ALL RIGHTS RESERVED</p>
                        <a href="">TERMS OF USE</a><a href="">PRIVACY POLICY</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>