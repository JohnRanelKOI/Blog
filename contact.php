<?php
    include_once("./includes/global_variables.php");
    include_once("./helpers/authentication.php");
    include_once(SITE_ROOT . "/includes/header.php");
?>
<main>
    <section class="contact-us">
        <div class="container">
            <div class="form-background">
                <div class="form-container">
                    <form>
                        <fieldset>
                            <legend>CONTACT</legend>
                            <div>
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter your name">
                            </div>
                            <div>
                                <label for="name">Email</label>
                                <input type="email" name="email" placeholder="Enter your email">
                            </div>
                            <div>
                                <label for="name">Subject</label>
                                <input type="text" name="subject" placeholder="Message Subject">
                            </div>
                            <div>
                                <label for="name">Message</label>
                                <textarea name="message" placeholder="Enter your message" rows="3"></textarea>
                            </div>
                            <button type="submit">Submit</button>
                        </fieldset>
                    </form>
                </div>
                <img src="./assets/images/contact/contact-us.png" alt="Contact us picture">
            </div>
        </div>
    </section>
</main>
<?php include_once(SITE_ROOT . "/includes/footer.php"); ?>