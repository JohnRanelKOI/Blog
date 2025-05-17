<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");

    $error_messages = [NULL, "Your username or password does not match our records."];
    if(isset($_GET) && isset($_GET["error"])) {
        $error = $error_messages[$_GET["error"]] ?? NULL;
    } else {
        $error = NULL;
    }
?>
<main>
    <section class="login">
        <div class="container">
            <div class="form-container">
                <h1>Login</h1>
                <form action="<?php echo SITE_URL; ?>/controllers/login.php" method="POST">
                    <div>
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Enter your name" required>
                        <div class="email-error-container"></div>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                        <div class="password-error-container"></div>
                    </div>
                    <button type="submit">Submit</button>
                    <?php if($error !== NULL) echo '<div class="return-error">' . $error . '</div>' ?>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>