<?php
    require("./../includes/global_variables.php");
    include_once(SITE_ROOT . "/helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/blog.php");
    require_once(SITE_ROOT . "/models/image.php");

    $blog_posts_init = new Blog($db_conn);
    $post_image_init = new Image($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            if(array_key_exists("id", $_GET)) {
                $blog_post_id = $_GET["id"];
                $blog_post = $blog_posts_init->getPostById($blog_post_id);
                echo json_encode($blog_post->fetch_assoc());
            }
            if(array_key_exists("skip", $_GET) && array_key_exists("limit", $_GET)) {
                $limit = $_GET["limit"];
                $skip = $_GET["skip"];
                $blog_post = $blog_posts_init->getLimitedPosts($limit, $skip);
                $rows = [];
                if ($blog_post->num_rows > 0) {
                    while ($row = $blog_post->fetch_assoc()) {
                        $rows[] = $row;
                    }
                }
                echo json_encode($rows);
            }
            if(array_key_exists("count", $_GET)) {
                $blog_post_count = $blog_posts_init->getCount();
                $blog_count = $blog_post_count->fetch_assoc();
                echo $blog_count["count"];
            }
            break;
        case "POST":
            unauthorizedAccessRedirect();
            $title = htmlspecialchars($_POST["title"] ?? '');
            $slug = convertTitleToURL($_POST["title"] ?? '');
            $short_description = htmlspecialchars($_POST["short_description"] ?? '');
            $content = htmlspecialchars($_POST["content"] ?? '');
            $category = htmlspecialchars($_POST["category"] ?? '');
            $date = htmlspecialchars($_POST["date"] ?? '');
            $file = $_FILES["post_image"];
            $new_blog_post_id = $blog_posts_init->insertNewPost($_SESSION["user_id"], "blog", $title, $slug, $short_description, $content, $category, $date);
            $post_image_init->insertNewImage($new_blog_post_id, $file, SITE_ROOT, SITE_URL);
            echo $new_blog_post_id;
            break;
        case "PUT":
            unauthorizedAccessRedirect();
            $input_data = file_get_contents("php://input");
            $post_data = json_decode($input_data, true);
            if(isset($post_data["post_image"])) {
                $post_image_init->updateImage($post_data["post_image"], $post_data["image_url"], SITE_ROOT);
            }
            $blog_posts_init->updatePost($post_data["id"], $post_data["title"], convertTitleToURL($post_data["title"]), $post_data["short_description"], $post_data["content"], $post_data["category"], $post_data["date"]);
            break;
        case "DELETE":
            unauthorizedAccessRedirect();
            $file_path = SITE_ROOT . "/uploads/" . basename($_GET["image_url"]);
            $post_image_init->deleteImage($_GET["id"], $file_path);
            $blog_posts_init->deletePost($_GET["id"]);
            break;
    }

    function convertTitleToURL($str) { 
        $str = strtolower($str); 
        $str = preg_replace('/[^a-z0-9]+/', '-', $str); 
        $str = trim($str, '-'); 
        return $str;
    }
?>