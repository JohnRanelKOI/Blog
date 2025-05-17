$(document).ready(function () {
    blogCards(0,6);
    
    $(document).on("click", ".more-blogs", async function() {
        let skip = parseInt($(this).attr("data-skip"));
        let limit = parseInt($(this).attr("data-limit"));

        let blog_posts = await blogCards(skip, limit);
        $(this).attr("data-skip", skip+limit);
        if(blog_posts.length < limit) $(".more-blogs").css("display", "none");
    });

    async function blogCards(skip, limit) {
        let blog_posts_parsed = await ajaxRequest(`?skip=${skip}&limit=${limit}`);
        let blog_posts = JSON.parse(blog_posts_parsed);

        for(let i = 0; i < blog_posts.length; i++) {
            $(".blog-posts").append(`
                <article data-category="${blog_posts[i].category}">
                    <a href="/blog-post.php?title=${blog_posts[i].slug_title}">
                        <figure>
                            <img src="${blog_posts[i].image_url}" alt="${blog_posts[i].title}">
                            <div class="overlay">
                                <span>Read More</span>
                            </div>
                            <figcaption>${blog_posts[i].title}</figcaption>
                        </figure>
                        <h3>${blog_posts[i].title}</h3>
                        <p>${blog_posts[i].short_description}</p>
                    </a>
                </article>
            `);
        }

        if(blog_posts.length === 0) {
            $(".more-blogs").text("No posts available.");
            $(".more-blogs").addClass("no-posts");
            $(".no-posts").removeClass("more-blogs");
        }

        return blog_posts;
    }

    async function ajaxRequest(requestData = "") {
        let message = null;
        await $.ajax({
            method: "GET",
            url: `/controllers/blog.php${requestData}`,
            contentType: false,
            processData: false,
        }).done(function(msg) {
            message = msg;
        });
        return message;
    }
});