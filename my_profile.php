<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");

    $message_array = [NULL, "Your profile is now updated."];
    if(isset($_GET) && isset($_GET["message"])) {
        $success_message = $message_array[$_GET["message"]] ?? NULL;
    } else {
        $success_message = NULL;
    }
?>
<main>
    <section class="register">
        <div class="container">
            <div class="form-container">
                <h1>My Profile</h1>
                <form action="<?php echo SITE_URL; ?>/controllers/user.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <div>
                        <label for="image">Profile picture</label>
                        <input type="file" name="image" accept=".png,.jpeg,.jpg,.webp"/>
                    </div>
                    <div>
                        <label for="first_name">First name</label>
                        <input type="text" name="first_name" placeholder="Enter your first name" value="<?php echo $_SESSION["first_name"]; ?>">
                        <div class="first_name-error-container"></div>
                    </div>
                    <div>
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name" placeholder="Enter your last name" value="<?php echo $_SESSION["last_name"]; ?>">
                        <div class="last_name-error-container"></div>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Enter your email" value="<?php echo $_SESSION["email"]; ?>">
                        <div class="email-error-container"></div>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" placeholder="Enter your phone number" value="<?php echo $_SESSION["phone"]; ?>">
                    </div>
                    <div>
                        <label for="address">Address</label>
                        <input type="text" name="address" placeholder="Enter your address" value="<?php echo $_SESSION["address"]; ?>">
                    </div>
                    <button type="submit">Submit</button>
                    <?php if($success_message !== NULL) echo '<div class="success-message">' . $success_message . '</div>'; ?>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>