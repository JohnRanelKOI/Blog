<?php
    require("./../includes/global_variables.php");
    require_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/user.php");

    $users_init = new User($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            $first_name = htmlspecialchars($_POST["first_name"] ?? '');
            $last_name = htmlspecialchars($_POST["last_name"] ?? '');
            $email = htmlspecialchars($_POST["email"] ?? '');
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

            $new_user_id = $users_init->insertNewUser($first_name, $last_name, $email, $password);
            header("Location: /register.php?message=1");
            break;
    }
?>