<?php
    require("./../includes/global_variables.php");
    include_once(SITE_ROOT . "/helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/config.php");
    require_once(SITE_ROOT . "/models/comment.php");

    $comments_init = new Comment($db_conn);

    switch($_SERVER["REQUEST_METHOD"]) {
        case "POST":
            insertComment($comments_init);
            break;
        case "PUT":
            updateComment($comments_init);
            break;
        case "DELETE":
            deleteComment($comments_init);
            break;
    }

    function insertComment($comments_init) {
        $user_id = $_SESSION["user_id"];
        $post_id = htmlspecialchars($_POST["post_id"] ?? '');
        $comment = htmlspecialchars($_POST["comment"] ?? '');
        $new_comment_id = $comments_init->insertNewComment($user_id, $post_id, $comment);
    }

    function updateComment($comments_init) {
        $input_data = file_get_contents("php://input");
        $comment_data = json_decode($input_data, true);
        $updated_comment_id = $comments_init->updateComment($comment_data["id"], $comment_data["comment"]);
    }

    function deleteComment($comments_init) {
        $comments_init->deleteComment($_GET["id"]);
    }
?>