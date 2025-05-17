<div class="form-modal" data-modal_name="update_comment_modal" role="dialog" aria-modal="true">
    <div class="container">
        <div class="modal-inner">
            <button class="close-modal" data-modal_name="update_comment_modal" ><img src="<?php echo SITE_URL; ?>/assets/images/flex/close.png" alt="Close image preview"></button>
            <form class="comments_form update_comment" method="PUT">
                <div>
                    <label for="comment">Comment</label>
                    <textarea name="comment" rows="10" placeholder="Enter updated comment here" required></textarea>
                </div>
                <button type="submit" class="update-comment-modal-btn">Update</button>
            </form>
        </div>
    </div>
</div>