$(document).ready(function () {
    ootdCards(0,6);

    $(document).on("click", ".more-ootds", async function() {
        let skip = parseInt($(this).attr("data-skip"));
        let limit = parseInt($(this).attr("data-limit"));

        let ootd_posts = await ootdCards(skip,limit);
        $(this).attr("data-skip", skip+limit);
        if(ootd_posts.length < limit) $(this).css("display", "none");
    });

    async function ootdCards(skip, limit) {
        let ootd_posts_parsed = await ajaxRequest(`?skip=${skip}&limit=${limit}`);
        let ootd_posts = JSON.parse(ootd_posts_parsed);

        for(let i = 0; i < ootd_posts.length; i++) {
            $(".ootd-posts").append(`
                <a data-weather="${ootd_posts[i].category}">
                    <figure>
                        <img src="${ootd_posts[i].image_url}" alt="${ootd_posts[i].title}">
                        <figcaption>${ootd_posts[i].title}</figcaption>
                    </figure>
                    <p>${ootd_posts[i].date}</p>
                    <h3>${ootd_posts[i].title}</h3>
                </a>
            `);
        }

        return ootd_posts;
    }

    async function ajaxRequest(requestData = "") {
        let message = null;
        await $.ajax({
            method: "GET",
            url: `/controllers/ootd.php${requestData}`,
            contentType: false,
            processData: false,
        }).done(function(msg) {
            message = msg;
        });
        return message;
    }
});