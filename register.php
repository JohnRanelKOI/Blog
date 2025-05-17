<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");

    $message_array = [NULL, "Your account is now created."];
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
                <h1>Register</h1>
                <form action="<?php echo SITE_URL; ?>/controllers/user.php" method="POST">
                    <div>
                        <label for="first_name">First name</label>
                        <input type="text" name="first_name" placeholder="Enter your first name">
                        <div class="first_name-error-container"></div>
                    </div>
                    <div>
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name" placeholder="Enter your last name">
                        <div class="last_name-error-container"></div>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Enter your email">
                        <div class="email-error-container"></div>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter your password">
                        <div class="password-error-container"></div>
                    </div>
                    <button type="submit">Submit</button>
                    <?php if($success_message !== null) echo '<div class="success-message">' . $success_message . '</div>'; ?>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>