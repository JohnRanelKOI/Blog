<?php
    require("./../includes/global_variables.php");
    include_once(SITE_ROOT . "/helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/user.php");

    $users_init = new User($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            if(!array_key_exists("_method", $_POST)) {
                registerUser($users_init);
            } else {
                updateUser($users_init);
            }
            break;
    }

    function registerUser($users_init) {
        $first_name = htmlspecialchars($_POST["first_name"] ?? '');
        $last_name = htmlspecialchars($_POST["last_name"] ?? '');
        $email = htmlspecialchars($_POST["email"] ?? '');
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $new_user_id = $users_init->insertNewUser($first_name, $last_name, $email, $password);
        header("Location: /register.php?message=1");
    }

    function updateUser($users_init) {
        $first_name = htmlspecialchars($_POST["first_name"] ?? '');
        $last_name = htmlspecialchars($_POST["last_name"] ?? '');
        $email = htmlspecialchars($_POST["email"] ?? '');
        $phone = htmlspecialchars($_POST["phone"] ?? '');
        $address = htmlspecialchars($_POST["address"] ?? '');
        $updated_user_id = $users_init->updateUser($_SESSION["user_id"], $first_name, $last_name, $email, $phone, $address);
        $updated_user_data = [
            "id" => $_SESSION["user_id"], 
            "role" => $_SESSION["role"], 
            "first_name" => $first_name, 
            "last_name" => $last_name, 
            "email" => $email, 
            "phone" => $phone, 
            "address" => $address
        ];
        setUserSession($updated_user_data);
        header("Location: /my_profile.php?message=1");
    }
?>