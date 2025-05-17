<?php
    require("./../includes/global_variables.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/comment.php");

    $comments_init = new Comment($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            $user_id = htmlspecialchars($_SESSION["user_id"] ?? '');
            $post_id = htmlspecialchars($_POST["post_id"] ?? '');
            $comment = htmlspecialchars($_POST["comment"] ?? '');
            $new_comment_id = $comments_init->insertNewComment($user_id, $post_id, $comment);
            break;
        case "PUT":
            $input_data = file_get_contents("php://input");
            $comment_data = json_decode($input_data, true);
            $updated_comment_id = $comments_init->updateComment($comment_data["id"], $comment_data["comment"]);
            break;
        case "DELETE":
            $comments_init->deleteComment($_GET["id"]);
            break;
    }
?>