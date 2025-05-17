<?php
    require("./../includes/global_variables.php");
    include_once(SITE_ROOT . "/helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/user.php");

    $users_init = new User($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            authenticateUser($users_init);
            break;
    }

    function authenticateUser($users_init) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user_fetch = $users_init->getUserByEmail($email);
        $user_data = $user_fetch->fetch_assoc();

        if(mysqli_num_rows($user_fetch) !== 0 && password_verify($password, $user_data["password"])) {
            setUserSession($user_data);
            if(isUserAdmin()) {
                header("Location: /admin/dashboard.php");
            } else {
                header("Location: /index.php");
            }
        } else {
            header("Location: /login.php?error=1");
        }
    }

    if(isset($_GET) && isset($_GET["logout"])) {
        logoutUser();
    }
?>