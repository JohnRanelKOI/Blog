<?php
    define("SITE_ROOT", "/var/www/html");
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on" ? "https://" : "http://";
    define("SITE_URL", $protocol . $_SERVER['HTTP_HOST']);
    define("SITE_PATH", substr($_SERVER['PHP_SELF'], 0, -4));
?>