<div class="form-modal" data-modal_name="create_update_post_modal" role="dialog" aria-modal="true">
    <div class="container">
        <div class="modal-inner">
            <button class="close-modal" data-modal_name="create_update_post_modal" ><img src="<?php echo SITE_URL; ?>/assets/images/flex/close.png" alt="Close image preview"></button>
            <form class="posts_form create-update-post" enctype="multipart/form-data">
                <div>
                    <label for="post_image">Post image</label>
                    <input type="file" name="post_image" accept=".png,.jpeg,.jpg,.webp"/>
                    <div class="post_image-error-container"></div>
                </div>
                <div>
                    <label for="name">Title</label>
                    <input type="text" name="title" placeholder="Enter title here" required/>
                    <div class="title-error-container"></div>
                </div>
                <?php
                    if(SITE_PATH === "/admin/blog") {
                        echo '<div>
                            <label for="short_description">Short Description</label>
                            <input type="text" name="short_description" placeholder="Enter short description here" required/>
                            <div class="short_description-error-container"></div>
                        </div>
                        <div>
                            <label for="content">Content</label>
                            <textarea name="content" rows="10" placeholder="Enter content here" required></textarea>
                            <div class="content-error-container"></div>
                        </div>';
                    }

                    if(SITE_PATH === "/admin/travel") {
                        echo '<div>
                            <label for="content">Content</label>
                            <textarea name="content" rows="10" placeholder="Enter content here" required></textarea>
                            <div class="content-error-container"></div>
                        </div>';
                    }
                ?>
                <div>
                    <label for="category">Category</label>
                    <select type="text" name="category" required>
                        <option>Select a category.</option>
                        <?php
                            $categories = [];
                            if(SITE_PATH === "/admin/travel") $categories = ["cultural","nature","city","spiritual"];
                            if(SITE_PATH === "/admin/blog") $categories = ["becoming","wanderlust","moments","style"];
                            if(SITE_PATH === "/admin/ootd") $categories = ["spring","summer","winter","fall"];
                            for($i = 0; $i < count($categories); $i++) {
                                echo "<option value=" . $categories[$i] . ">" . strtoupper($categories[$i]) . "</option>";
                            }
                        ?>
                    </select>
                    <div class="category-error-container"></div>
                </div>
                <div>
                    <label for="date">Date</label>
                    <input type="date" name="date" required/>
                    <div class="date-error-container"></div>
                </div>
                <button type="submit" class="create-update-post-btn">Create</button>
            </form>
        </div>
    </div>
</div>