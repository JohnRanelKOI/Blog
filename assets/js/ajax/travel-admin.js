$(document).ready(function() {
    tableLoadData(0, 10);

    $(document).on("click", ".create-post", function(event) {
        event.preventDefault();
        let modal_name = $(this).attr("data-modal_name");
        $(".form-modal[data-modal_name='" + modal_name + "']").css("display", "block");
        $(".create-update-post").removeAttr("data-id");
        $(".create-update-post").removeAttr("data-img_url");

        if(!$(".create-update-post").hasClass("posts_form")) {
            $(".create-update-post").addClass("posts_form");
            $(".create-update-post-btn").text("Create");
        }

        if($(".create-update-post").hasClass("updates_form"))
            $(".create-update-post").removeClass("updates_form");
        
        setFormElement(null);
    });

    $(document).on("click", ".edit-post", async function(event) {
        event.preventDefault();
        let post_id = $(this).attr("data-id");
        $(".create-update-post").attr("data-id", post_id);
        let modal_name = $(this).attr("data-modal_name");
        $(".form-modal[data-modal_name='" + modal_name + "']").css("display", "block");
        
        if(!$(".create-update-post").hasClass("updates_form")) {
            $(".create-update-post").addClass("updates_form");
            $(".create-update-post-btn").text("Update");
        }

        if($(".create-update-post").hasClass("posts_form"))
            $(".create-update-post").removeClass("posts_form");

        let post_details_parsed = await ajaxRequest("GET", "", `?id=${post_id}`);
        let post_details = JSON.parse(post_details_parsed);
        setFormElement(post_details);
    });

    $(document).on("click", ".close-modal", function() {
        let modal_name = $(this).attr("data-modal_name");
        $(".form-modal[data-modal_name='" + modal_name + "']").css("display", "none");
    });

    $(document).on("click", ".delete-post", function(event) {
        event.preventDefault();
        let modal_name = $(this).attr("data-modal_name");
        let post_id = $(this).attr("data-id");
        let image_url = $(this).attr("data-image_url");
        $(".form-modal[data-modal_name='" + modal_name + "']").css("display", "block");
        $(".form-modal[data-modal_name='" + modal_name + "']").find(".confirm").attr("data-id", post_id);
        $(".form-modal[data-modal_name='" + modal_name + "']").find(".confirm").attr("data-image_url", image_url);
        $(`.row-${post_id}`).remove();
    });

    $(document).on("click", ".delete-post-confirm", function(event) {
        event.preventDefault();
        let post_id = $(this).attr("data-id");
        let image_url = $(this).attr("data-image_url");
        ajaxRequest("DELETE", "", `?id=${post_id}&image_url=${image_url}`);
        $(`.row-${post_id}`).remove();
        $(`.row-${post_id}`).remove();
        $(".form-modal[data-modal_name='delete_post_modal'").css("display", "none");
    });

    $(document).on("click", ".paginate", async function() {
        let skip = $(this).attr("data-skip");
        let travel_posts_parsed = await ajaxRequest("GET", "", `?skip=${skip}&limit=10`);
        let travel_posts = JSON.parse(travel_posts_parsed);
        $(".table-body").html("");
        for(let i = 0; i < travel_posts.length; i++) {
            setTableContent(travel_posts[i], "PAGINATE");
        }
    });

    $(document).on("submit", "form", async function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        if($(this).hasClass("updates_form")) {
            formData.append("id", $(this).attr("data-id"));
            formData.append("image_url", $(this).attr("data-img_url"));
            let formDataObj = await convertFormData(formData)
            ajaxRequest("POST", formData, "?type=update");
            setTableContent(formDataObj, "PUT");
            $(".form-modal[data-modal_name='create_update_post_modal']").css("display", "none");
        } else {
            let post_id = await ajaxRequest("POST", formData, "?type=create");
            formData.append("id", post_id);
            let formDataObj = await convertFormData(formData);
            setTableContent(formDataObj, "POST");
            $(".form-modal[data-modal_name='create_update_post_modal']").css("display", "none");
        }
    });

    async function tableLoadData(skip, limit) {
        $(".page-title").text("Travel");
        $(".table-head").append(`
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Action</th>
        `);

        let travel_posts_parsed = await ajaxRequest("GET", "", `?skip=${skip}&limit=${limit}`);
        let travel_posts = JSON.parse(travel_posts_parsed);
        for(let i = 0; i < travel_posts.length; i++) {
            setTableContent(travel_posts[i], "PAGINATE");
        }

        let travel_posts_count = await ajaxRequest("GET", "", `?count=true`);
        let result = Math.ceil(travel_posts_count / 10);
        let j = 0;
        while(j<result) {
            $(".pagination>ul").append(`<li class="paginate" data-page="${j+1}" data-skip="${(j)*limit}">${j+1}</li>`)
            j++;
        }
    }

    function fileReader(image) {
        return new Promise((resolve, reject) => {
            let image_reader = new FileReader();
            image_reader.onload = e => resolve(e.target.result);
            image_reader.onerror = reject;
            image_reader.readAsDataURL(image);
        });
    }

    async function convertFormData(formData) {
        var formDataObj = {};
        for(const entry of formData.entries()) {
            let [key, value] = entry;
            if(key === "post_image") {
                if(value.name !== "") {
                    formDataObj[key] = await fileReader(value);
                }
            } else {
                formDataObj[key] = value;
            }
        }
        return formDataObj;
    }

    function setTableContent(post_details, method) {
        if(method == "PUT") $(`.row-${post_details.id}`).html("");
        let tableContent = `
            <td>${post_details.title}</td>
            <td>${post_details.category}</td>
            <td>${post_details.date}</td>
            <td><button class="edit-post" data-modal_name="create_update_post_modal" data-id="${post_details.id}">Edit</button> <button class="delete-post" data-modal_name="delete_post_modal" data-image_url="${post_details.image_url}" data-id="${post_details.id}">Delete</button></td>
        `;

        if(method === "PUT") $(`.row-${post_details.id}`).append(tableContent);
        if(method === "POST") $(`.table-body`).prepend(`<tr class="row-${post_details.id}">${tableContent}</tr>`);
        if(method === "PAGINATE") $(`.table-body`).append(`<tr class="row-${post_details.id}">${tableContent}</tr>`);
    }

    function setFormElement(post_details) {
        $("input[name=title]").val((post_details) ? post_details.title : null);
        $("textarea[name=content]").val((post_details) ? post_details.content : null);
        $("select[name=category]").val((post_details) ? post_details.category : null);
        $("input[name=date]").val((post_details) ? post_details.date : null);
        $(".create-update-post").attr("data-img_url", (post_details) ? post_details.image_url : null);
    }

    async function ajaxRequest(method, formData = "", requestData = "") {
        let message = null;
        await $.ajax({
            method: method,
            url: `/controllers/travel.php${requestData}`,
            data: (method == "PUT") ? JSON.stringify(formData) : formData,
            contentType: false,
            processData: false,
        }).done(function(msg) {
            message = msg;
        });
        return message;
    }
});