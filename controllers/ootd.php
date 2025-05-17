<?php
    require("./../includes/global_variables.php");
    include_once(SITE_ROOT . "/helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/ootd.php");
    require_once(SITE_ROOT . "/models/image.php");

    $ootd_posts_init = new Ootd($db_conn);
    $post_image_init = new Image($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(array_key_exists("id", $_GET)) {
                echo fetchOotdById($ootd_posts_init);
            }
            if(array_key_exists("skip", $_GET) && array_key_exists("limit", $_GET)) {
               echo paginateOotd($ootd_posts_init);
            }
            if(array_key_exists("count", $_GET)) {
               echo getOotdTotalCount($ootd_posts_init);
            }
            break;
        case "POST":
            unauthorizedAccessRedirect();
            echo insertOotdPost($ootd_posts_init, $post_image_init);
            break;
        case "PUT":
            unauthorizedAccessRedirect();
            updateOotdPost($ootd_posts_init, $post_image_init);
            break;
        case "DELETE":
            unauthorizedAccessRedirect();
            deleteOotdPost($ootd_posts_init, $post_image_init);
            break;
    }

    function fetchOotdById($ootd_posts_init) {
        $ootd_post_id = $_GET["id"];
        $ootd_post = $ootd_posts_init->getPost($ootd_post_id);
        return json_encode($ootd_post->fetch_assoc());
    }

    function paginateOotd($ootd_posts_init) {
        $limit = $_GET["limit"];
        $skip = $_GET["skip"];
        $ootd_post = $ootd_posts_init->getLimitedPosts($limit, $skip);
        $rows = [];
        if ($ootd_post->num_rows > 0) {
            while ($row = $ootd_post->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return json_encode($rows);
    }

    function getOotdTotalCount($ootd_posts_init) {
        $ootd_post_count = $ootd_posts_init->getCount();
        $ootd_count = $ootd_post_count->fetch_assoc();
        return $ootd_count["count"];
    }

    function insertOotdPost($ootd_posts_init, $post_image_init) {
        $title = htmlspecialchars($_POST["title"] ?? '');
        $category = htmlspecialchars($_POST["category"] ?? '');
        $date = htmlspecialchars($_POST["date"] ?? '');
        $file = $_FILES["post_image"];
        $new_ootd_post_id = $ootd_posts_init->insertNewPost($_SESSION["user_id"], "ootd", $title, $category, $date);
        $post_image_init->insertNewImage($new_ootd_post_id, $file, SITE_ROOT, SITE_URL);
        return $new_ootd_post_id;
    }

    function updateOotdPost($ootd_posts_init, $post_image_init) {
        $input_data = file_get_contents("php://input");
        $post_data = json_decode($input_data, true);
        if(isset($post_data["post_image"])) {
            $post_image_init->updateImage($post_data["post_image"], $post_data["image_url"], SITE_ROOT);
        }
        $ootd_posts_init->updatePost($post_data["id"], $post_data["title"], $post_data["category"], $post_data["date"]);
    }

    function deleteOotdPost($ootd_posts_init, $post_image_init) {
        $file_path = SITE_ROOT . "/uploads/" . basename($_GET["image_url"]);
        $post_image_init->deleteImage($_GET["id"], $file_path);
        $ootd_posts_init->deletePost($_GET["id"]);
    }
?>