$(document).ready(function () {
    travelCards(0,6);

    $(document).on("click", ".more-travels", async function() {
        let skip = parseInt($(this).attr("data-skip"));
        let limit = parseInt($(this).attr("data-limit"));

        let travel_posts = await travelCards(skip,limit);
        $(this).attr("data-skip", skip+limit);
        if(travel_posts.length < limit) $(".more-travels").css("display", "none");
    });

    async function travelCards(skip, limit) {
        let travel_posts_parsed = await ajaxRequest(`?skip=${skip}&limit=${limit}`);
        let travel_posts = JSON.parse(travel_posts_parsed);

        for(let i = 0; i < travel_posts.length; i++) {
            $(".travel-posts").append(`
                <article data-type="${travel_posts[i].category}">
                    <a href="/travel_post.php?title=${travel_posts[i].slug_title}">
                        <figure>
                            <img src="${travel_posts[i].image_url}" alt="${travel_posts[i].title}">
                            <div class="overlay">
                                <span>Read More</span>
                            </div>
                            <figcaption>${travel_posts[i].title}</figcaption>
                        </figure>
                    </a>
                </article>
            `);
        }

        if(travel_posts.length === 0) {
            $(".more-travels").text("No posts available.");
            $(".more-travels").addClass("no-posts");
            $(".no-posts").removeClass("more-travels");
        }

        return travel_posts;
    }

    async function ajaxRequest(requestData = "") {
        let message = null;
        await $.ajax({
            method: "GET",
            url: `/controllers/travel.php${requestData}`,
            contentType: false,
            processData: false,
        }).done(function(msg) {
            message = msg;
        });
        return message;
    }
});