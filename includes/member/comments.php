<h3>Comments</h3>
<div class="comment-section">
    <?php
        if($comments_data->num_rows != 0) {
            while($row = $comments_data->fetch_assoc()) {
                $buttons = "";
                if(isLoggedIn()) {
                    if($row["user_id"] == $_SESSION["user_id"]) {
                        $buttons .= '<button class="update-comment-btn" data-modal_name="update_comment_modal" data-id="' . $row["id"] . '" data-comment="' . $row["comment"] . '">Update</button>';
                        $buttons .= '<button class="delete-comment-btn" data-modal_name="delete_comment_modal" data-id="' . $row["id"] . '">Delete</button>';
                    }
                }
                echo '<div class="comment">
                    <div>
                        <img src="data:image/png;base64,' . base64_encode($row["image"]) . '" alt="user profile picture" />
                    </div>
                    <div>
                        <span>' . $row["first_name"] . " " . $row["last_name"] . '<span>'. date('j M Y', strtotime($row["created_at"])) .'</span></span>
                        <p>' . $row["comment"] . '</p>
                        ' . $buttons . '
                    </div>
                </div>';
            }
        } else {
            echo '<div class="no-posts">No comments available.</div>';
        }
    ?>
    <?php if(isLoggedIn()) { ?>
        <div class="comment-input">
            <h4>Write a comment</h4>
            <form class="create_comment" method="POST" data-post_id="<?php echo SITE_PATH === "/travel_post" ?  $travel_post["id"] : $blog_post["id"]; ?>">
                <textarea name="comment" rows="5" placeholder="Write your comments..." required></textarea>
                <button type="submit">Submit</button>
                <div class="comment-error-container"></div>
            </form>
        </div>
    <?php } ?>
</div>
<?php include_once(SITE_ROOT . "/includes/member/delete_comment.php") ?>
<?php include_once(SITE_ROOT . "/includes/member/update_comment.php") ?>