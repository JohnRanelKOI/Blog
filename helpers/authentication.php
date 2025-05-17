<?php
    if(session_status() === PHP_SESSION_NONE) session_start();
    if(SITE_PATH == "/admin/dashboard" || SITE_PATH == "/admin/blog" || SITE_PATH == "/admin/travel" || SITE_PATH == "/admin/ootd") {
        if(isUserAdmin() === false) {
            header("Location: /login.php");
        }
    }

    function setUserSession($user_data) {
        $_SESSION["user_id"] = $user_data["id"];
        $_SESSION["first_name"] = $user_data["first_name"];
        $_SESSION["last_name"] = $user_data["last_name"];
        $_SESSION["email"] = $user_data["email"];
        $_SESSION["role"] = $user_data["role"];
        $_SESSION["logged_in"] = true;
    }

    function isLoggedIn() {
        if(!isset($_SESSION["logged_in"])) {
            return false;
        }
        return true;
    }

    function isUserAdmin() {
        if(!isLoggedIn() || (isLoggedIn() && $_SESSION["role"] !== "admin")) {
            return false;
        }
        return true;
    }

    function logoutUser() {
        if(isLoggedIn() && session_status() !== PHP_SESSION_NONE) {
            session_destroy();
            header("Location: /login.php");
        }
    }
?>