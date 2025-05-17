$(document).ready(function() {
    $(document).on("submit", ".create_comment", async function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append("post_id", $(this).attr("data-post_id"));
        ajaxRequest("POST", formData);
    });

    $(document).on("submit", ".update_comment", async function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        let formDataObj = {};
        formData.append("id", $(this).attr("data-id"));
        for(const entry of formData.entries()) {
            let [key, value] = entry;
            formDataObj[key] = value;
        }
        ajaxRequest("PUT", formDataObj);
    });

    $(document).on("click", ".update-comment-btn", function(event) {
        event.preventDefault();
        let comment_id = $(this).attr("data-id");
        let modal_name = $(this).attr("data-modal_name");
        let comment_content = $(this).attr("data-comment");
        $(".update_comment").attr("data-id", comment_id);
        $(".update_comment>div>textarea").val(comment_content);
        $(".form-modal[data-modal_name='" + modal_name + "']").css("display", "block");
    });

    $(document).on("click", ".delete-comment-btn", function(event) {
        event.preventDefault();
        let modal_name = $(this).attr("data-modal_name");
        let comment_id = $(this).attr("data-id");
        $(".form-modal[data-modal_name='" + modal_name + "']").css("display", "block");
        $(".form-modal[data-modal_name='" + modal_name + "']").find(".confirm").attr("data-id", comment_id);
    });

    $(".delete-comment-confirm").on("click", function(event) {
        event.preventDefault();
        let comment_id = $(this).attr("data-id");
        ajaxRequest("DELETE", "", `?id=${comment_id}`);
    });

    $(".close-modal").on("click", function() {
        let modal_name = $(this).attr("data-modal_name");
        $(".form-modal[data-modal_name='" + modal_name + "']").css("display", "none");
    });

    async function ajaxRequest(method, formData = "", requestData = "") {
        let message = null;
        await $.ajax({
            method: method,
            url: `/controllers/comment.php${requestData}`,
            data: (method == "PUT") ? JSON.stringify(formData) : formData,
            contentType: false,
            processData: false,
        }).done(function(msg) {
            message = msg;
        });
        console.log(message);
        return message;
    }
});