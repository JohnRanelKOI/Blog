<aside>
    <h2>Manage</h2>
    <ul>
        <li><a href="<?php echo SITE_URL; ?>/admin/dashboard.php" <?php echo $navigation->ifPageActiveReturnClassActive("admin/dashboard"); ?>>DASHBOARD</a></li>
        <li><a href="<?php echo SITE_URL; ?>/admin/travel.php" <?php echo $navigation->ifPageActiveReturnClassActive("admin/travel"); ?>>TRAVEL POSTS</a></li>
        <li><a href="<?php echo SITE_URL; ?>/admin/blog.php" <?php echo $navigation->ifPageActiveReturnClassActive("admin/blog"); ?>>BLOG POSTS</a></li>
        <li><a href="<?php echo SITE_URL; ?>/admin/ootd.php" <?php echo $navigation->ifPageActiveReturnClassActive("admin/ootd"); ?>>OOTD POSTS</a></li>
    </ul>
</aside>