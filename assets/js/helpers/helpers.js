$(document).ready(function() {
    var currentURL = window.location.pathname;
    let validations = {};
    

    if(currentURL == "/login.php") {
        $("button[type=submit]").attr("disabled", "disabled");
        validations.email = false;
        validations.password = false;

        checkInput("email", isValidEmail, "Enter valid a email address.", "button[type=submit]");
        checkInput("password", hasValidLength, "Password should contain atleast 1 character.", "button[type=submit]");
    }

    if(currentURL == "/register.php") {
        $("button[type=submit]").attr("disabled", "disabled");
        validations.first_name = false;
        validations.last_name = false;
        validations.email = false;
        validations.password = false;

        checkInput("first_name", hasValidLength, "First name should contain atleast 1 character.", "button[type=submit]");
        checkInput("last_name", hasValidLength, "Last name should contain atleast 1 character.", "button[type=submit]");
        checkInput("email", isValidEmail, "Enter valid a email address.", "button[type=submit]");
        checkInput("password", isValidPassword, "Password must consist of aleast 8 chars, 1 num, 1 special char (!@#$%&*).", "button[type=submit]");
    }

    if(currentURL == "/my_profile.php") {
        validations.first_name = true;
        validations.last_name = true;
        validations.email = true;

        checkInput("first_name", hasValidLength, "First name should contain atleast 1 character.", "button[type=submit]");
        checkInput("last_name", hasValidLength, "Last name should contain atleast 1 character.", "button[type=submit]");
        checkInput("email", isValidEmail, "Enter valid a email address.", "button[type=submit]");
    }

    if(currentURL == "/travel_post.php" || currentURL == "/blog_post.php") {
        $(".create_comment>button[type=submit]").attr("disabled", "disabled");
        validations.comment = false;
        checkInput("comment", hasValidLength, "Comment should contain atleast 2 character.", ".create_comment>button[type=submit]", ".create_comment>textarea[name=comment]");

        $(".update_comment>button[type=submit]").attr("disabled", "disabled");
        checkInput("comment", hasValidLength, "Comment should contain atleast 2 character.", ".update_comment>button[type=submit]", ".update_comment>div>textarea[name=comment]");
    }

    if(currentURL == "/admin/travel.php" || currentURL == "/admin/blog.php" || currentURL == "/admin/ootd.php") {
        $(".create-update-post>button[type=submit]").attr("disabled", "disabled");
        validations.post_image = false;
        validations.title = false;
        if(currentURL === "/admin/blog.php") validations.short_description = false;
        if(currentURL !== "/admin/ootd.php") validations.content = false;
        validations.date = false;
        validations.category = false;

        $(document).on("click", ".create-post", function(event) {
            $(".create-update-post>button[type=submit]").attr("disabled", "disabled");
            validations.post_image = false;
            validations.title = false;
            if(currentURL === "/admin/blog.php") validations.short_description = false;
            if(currentURL !== "/admin/ootd.php") validations.content = false;
            validations.date = false;
            validations.category = false;
        });

        $(document).on("click", ".edit-post", function(event) {
            $(".create-update-post>button[type=submit]").removeAttr("disabled");
            validations.post_image = true;
            validations.title = true;
            if(currentURL === "/admin/blog.php") validations.short_description = true;
            if(currentURL !== "/admin/ootd.php") validations.content = true;
            validations.date = true;
            validations.category = true;
        });

        checkFileSelectInput("post_image", isFileSelected, "Image is required.", ".create-update-post>button[type=submit]", ".create-update-post>div>input[name=post_image]");
        checkInput("title", hasValidLength, "Title should contain atleast 2 character.", ".create-update-post>button[type=submit]", ".create-update-post>div>input[name=title]");
        if(currentURL === "/admin/blog.php") checkInput("short_description", hasValidLength, "Short Description should contain atleast 2 character.", ".create-update-post>button[type=submit]", ".create-update-post>div>input[name=short_description]");
        if(currentURL !== "/admin/ootd.php") checkInput("content", hasValidLength, "Content should contain atleast 2 character.", ".create-update-post>button[type=submit]", ".create-update-post>div>textarea[name=content]");
        checkInput("date", hasValidLength, "Date is required.", ".create-update-post>button[type=submit]", ".create-update-post>div>input[name=date]");
        checkFileSelectInput("category", hasSelected, "Category should be selected.", ".create-update-post>button[type=submit]", ".create-update-post>div>select[name=category]");
    }

    function checkInput(field_name, input_check, error_message, button, elem_target=null) {
        let elem = (elem_target) ? elem_target : `input[name=${field_name}]`;
        $(elem).on("keyup", function() {
            $(`.${field_name}-error-container`).html(null);
            validations[field_name] = true;
            if(!input_check($(this).val())) {
                validations[field_name] = false;
                $(`.${field_name}-error-container`).append(`<span class='error-message'>${error_message}</span>`);
            }
            checkInputsIfValid(button);
        });
    }

    function checkFileSelectInput(field_name, input_check, error_message, button, elem_target=null) {
        let elem = (elem_target) ? elem_target : `input[name=${field_name}]`;
        $(elem).on("change", function() {
            $(`.${field_name}-error-container`).html(null);
            validations[field_name] = true;
            if(input_check(this)) {
                validations[field_name] = false;
                $(`.${field_name}-error-container`).append(`<span class='error-message'>${error_message}</span>`);
            }
            checkInputsIfValid(button);
        });
    }

    function isFileSelected(file_input) {
        if($(file_input)[0].files.length === 0) {
            return true;
        }
        return false;
    }

    function hasSelected(select) {
        if($(select).val() === "Select a category.") {   
            return true;
        }
        return false;
    }

    function checkInputsIfValid(button) {
        $.each(validations, function (key, val) {
            if(val) {
                $(button).removeAttr("disabled");
            } else {
                $(button).attr("disabled", "disabled");
                return false;
            }
        });
    }

    function isValidEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    function isValidPassword(password) {
        var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
        return regex.test(password);
    }

    function hasValidLength(password) {
        if(password.length >= 2) {   
            return true;
        }
        return false;
    }
});