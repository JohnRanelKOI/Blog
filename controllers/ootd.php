<?php
    require("./../includes/global_variables.php");
    require_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/ootd.php");
    require_once(SITE_ROOT . "/models/image.php");

    $ootd_posts_init = new Ootd($db_conn);
    $post_image_init = new Image($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(array_key_exists("id", $_GET)) {
                $ootd_post_id = $_GET["id"];
                $ootd_post = $ootd_posts_init->getPost($ootd_post_id);
                echo json_encode($ootd_post->fetch_assoc());
            }
            if(array_key_exists("skip", $_GET) && array_key_exists("limit", $_GET)) {
                $limit = $_GET["limit"];
                $skip = $_GET["skip"];
                $ootd_post = $ootd_posts_init->getLimitedPosts($limit, $skip);
                $rows = [];
                if ($ootd_post->num_rows > 0) {
                    while ($row = $ootd_post->fetch_assoc()) {
                        $rows[] = $row;
                    }
                }
                echo json_encode($rows);
            }
            if(array_key_exists("count", $_GET)) {
                $ootd_post_count = $ootd_posts_init->getCount();
                $ootd_count = $ootd_post_count->fetch_assoc();
                echo $ootd_count["count"];
            }
            break;
        case "POST":
            $title = htmlspecialchars($_POST["title"] ?? '');
            $category = htmlspecialchars($_POST["category"] ?? '');
            $date = htmlspecialchars($_POST["date"] ?? '');
            $file = $_FILES["post_image"];
            $new_ootd_post_id = $ootd_posts_init->insertNewPost(1, "ootd", $title, $category, $date);
            $post_image_init->insertNewImage($new_ootd_post_id, $file, SITE_ROOT, SITE_URL);
            echo $new_ootd_post_id;
            break;
        case "PUT":
            $input_data = file_get_contents("php://input");
            $post_data = json_decode($input_data, true);
            if(isset($post_data["post_image"])) {
                $post_image_init->updateImage($post_data["post_image"], $post_data["image_url"], SITE_ROOT);
            }
            $ootd_posts_init->updatePost($post_data["id"], $post_data["title"], $post_data["category"], $post_data["date"]);
            break;
        case "DELETE":
            $file_path = SITE_ROOT . "/uploads/" . basename($_GET["image_url"]);
            $post_image_init->deleteImage($_GET["id"], $file_path);
            $ootd_posts_init->deletePost($_GET["id"]);
            break;
    }
?>