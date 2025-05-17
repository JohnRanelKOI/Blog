<?php
    require("./../includes/global_variables.php");
    include_once(SITE_ROOT . "/helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/travel.php");
    require_once(SITE_ROOT . "/models/image.php");

    $travel_posts_init = new Travel($db_conn);
    $post_image_init = new Image($db_conn);


    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(array_key_exists("id", $_GET)) {
                echo fetchTravelById($travel_posts_init);
            }
            if(array_key_exists("skip", $_GET) && array_key_exists("limit", $_GET)) {
                echo paginateTravel($travel_posts_init);
            }
            if(array_key_exists("count", $_GET)) {
                echo getTravelTotalCount($travel_posts_init);
            }
            break;
        case "POST":
            unauthorizedAccessRedirect();
            echo insertTravelPost($travel_posts_init, $post_image_init);
            break;
        case "PUT":
            unauthorizedAccessRedirect();
            updateTravelPost($travel_posts_init, $post_image_init);
            break;
        case "DELETE":
            unauthorizedAccessRedirect();
            deleteTravelPost($travel_posts_init, $post_image_init);
            break;
    }

    function fetchTravelById($travel_posts_init) {
        $travel_post_id = $_GET["id"];
        $travel_post = $travel_posts_init->getPostById($travel_post_id);
        return json_encode($travel_post->fetch_assoc());
    }

    function paginateTravel($travel_posts_init) {
        $limit = $_GET["limit"];
        $skip = $_GET["skip"];
        $travel_post = $travel_posts_init->getLimitedPosts($limit, $skip);
        $rows = [];
        if ($travel_post->num_rows > 0) {
            while ($row = $travel_post->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return json_encode($rows);
    }

    function getTravelTotalCount($travel_posts_init) {
        $travel_post_count = $travel_posts_init->getCount();
        $travel_count = $travel_post_count->fetch_assoc();
        return $travel_count["count"];
    }

    function insertTravelPost($travel_posts_init, $post_image_init) {
        $title = htmlspecialchars($_POST["title"] ?? '');
        $slug = convertTitleToURL($_POST["title"] ?? '');
        $content = htmlspecialchars($_POST["content"] ?? '');
        $category = htmlspecialchars($_POST["category"] ?? '');
        $date = htmlspecialchars($_POST["date"] ?? '');
        $file = $_FILES["post_image"];
        $new_travel_post_id = $travel_posts_init->insertNewPost($_SESSION["user_id"], "travel", $title, $slug, $content, $category, $date);
        $post_image_init->insertNewImage($new_travel_post_id, $file, SITE_ROOT, SITE_URL);
        return $new_travel_post_id;
    }

    function updateTravelPost($travel_posts_init, $post_image_init) {
        $input_data = file_get_contents("php://input");
        $post_data = json_decode($input_data, true);
        if(isset($post_data["post_image"])) {
            $post_image_init->updateImage($post_data["post_image"], $post_data["image_url"], SITE_ROOT);
        }
        $travel_posts_init->updatePost($post_data["id"], $post_data["title"], convertTitleToURL($post_data["title"]), $post_data["content"], $post_data["category"], $post_data["date"]);
    }

    function deleteTravelPost($travel_posts_init, $post_image_init) {
        $file_path = SITE_ROOT . "/uploads/" . basename($_GET["image_url"]);
        $post_image_init->deleteImage($_GET["id"], $file_path);
        $travel_posts_init->deletePost($_GET["id"]);
    }

    function convertTitleToURL($str) { 
        $str = strtolower($str); 
        $str = preg_replace('/[^a-z0-9]+/', '-', $str); 
        $str = trim($str, '-'); 
        return $str;
    }
?>