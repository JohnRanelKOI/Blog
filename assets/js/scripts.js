$(document).ready(function () {
    // MOBILE NAVIGATION BURGER
    $(".burger").on("click", function(){
        $(".burger").addClass("burger-open");
        $(".menu-container").addClass("is-open");
    });

    $(".close-menu").on("click", function(){
        $(".burger").removeClass("burger-open");
        $(".menu-container").removeClass("is-open");
    });

    // TRAVEL INDEX HOVER EFFECT
    $("main > .travel > .container > .travel-posts > article").on("mouseover", function() {
        $(this).find("figure > figcaption").css("margin", "-50px 0 0px");
        $(this).find("figure > img").css("filter", "brightness(70%)");
        $(this).find("figure > .overlay").css("opacity", "1");
        $(this).find("figure > .overlay > span").css("padding-right", "10px");
    });

    $("main > .travel > .container > .travel-posts > article").on("mouseleave", function() {
        $(this).find("figure > figcaption").css("margin", "-28px 0 0px");
        $(this).find("figure > img").css("filter", "brightness(100%)");
        $(this).find("figure > .overlay").css("opacity", "0");
        $(this).find("figure > .overlay > span").css("padding-right", "0px");
    });

    // BLOG INDEX HOVER EFFECT
    $(".blog-posts > article").on("mouseover", function () {
        $(this).find("a > figure > img").css("filter", "brightness(70%)");
        $(this).find("a > figure > .overlay").css("opacity", "1");
        $(this).find("a > figure > .overlay > span").css("padding-right", "10px");
    });

    $(".blog-posts > article").on("mouseleave", function () {
        $(this).find("a > figure > img").css("filter", "brightness(100%)");
        $(this).find("a > figure > .overlay").css("opacity", "0");
        $(this).find("a > figure > .overlay > span").css("padding-right", "0px");
    });

    // BLOG PAGE HOVER EFFECT
    $("main > .blog > .container > .blog-posts > a").on("mouseover", function () {
        $(this).find("img").css("margin-left", "20px");
    });

    $("main > .blog > .container > .blog-posts > a").on("mouseleave", function () {
        $(this).find("img").css("margin-left", "10px");
    });

    // BLOG PAGE BUTTON FILTERS
    $(".blog > .container > .filters > button").on("click", function () {
        if($(this).attr("data-filter") == "all") {
            $(".blog > .container > .blog-posts > article").css("display", "block");
        } else {
            $("[data-category='"+ $(this).attr("data-filter") +"']").css("display", "block");
            $(".blog > .container > .blog-posts > article").not("[data-category='"+ $(this).attr("data-filter") +"']").css("display", "none");
        }
    });

    // BLOG PAGE INPUT KEYWORD FILTER
    $(".blog > .container > input").on("keyup", function () {
        let keyword = $(this).val();
        let articlesLength = $(".blog > .container > .blog-posts > article").length;
        for(let i=0; i<articlesLength; i++) {
            let lowercaseTitle = $(".blog > .container > .blog-posts > article").eq(i).find("h3").text().toLowerCase();
            if(lowercaseTitle.includes(keyword)) {
                $(".blog > .container > .blog-posts > article").eq(i).css("display", "block");
            } else {
                $(".blog > .container > .blog-posts > article").eq(i).css("display", "none");
            }
        }
    });

    // TRAVEL PAGE HOVER EFFECT
    $("main > .travel > .travel-images > a").on("mouseover", function () {
        $(this).find("img").css("margin-left", "20px");
    });

    $("main > .travel > .travel-images > a").on("mouseleave", function () {
        $(this).find("img").css("margin-left", "10px");
    });

    // TRAVEL PAGE BUTTON FILTERS
    $(".travel > .container > .filters > button").on("click", function () {
        if($(this).attr("data-filter") == "all") {
            $(".travel > .container > .travel-posts > article").css("display", "block");
        } else {
            $("[data-type='"+ $(this).attr("data-filter") +"']").css("display", "block");
            $(".travel > .container > .travel-posts > article").not("[data-type='"+ $(this).attr("data-filter") +"']").css("display", "none");
        }
    });

    // TRAVEL PAGE INPUT KEYWORD FILTER
    $(".travel > .container > input").on("keyup", function () {
        let keyword = $(this).val();
        let articlesLength = $(".travel > .container > .travel-posts > article").length;
        for(let i=0; i<articlesLength; i++) {
            let lowercaseTitle = $(".travel > .container > .travel-posts > article").eq(i).find("a > figure > figcaption").text().toLowerCase();
            if(lowercaseTitle.includes(keyword)) {
                $(".travel > .container > .travel-posts > article").eq(i).css("display", "block");
            } else {
                $(".travel > .container > .travel-posts > article").eq(i).css("display", "none");
            }
        }
    });

    // OOTD INDEX HOVER EFFECT
    $("main > .ootd > .container > .ootd-container > figure").on("mouseover", function () {
        $(this).find("img").css("filter", "brightness(70%)");
    });

    $("main > .ootd > .container > .ootd-container > figure").on("mouseleave", function () {
        $(this).find("img").css("filter", "brightness(100%)");
    });

    // OOTD INDEX CLICK PREVIEW
    $("main > .ootd > .container > .ootd-container > figure").on("click", function () {
        let image_source = $(this).find("img").attr("src");
        let image_alt = $(this).find("img").attr("alt");
        $(".preview-image").attr("src", image_source);
        $(".preview-image").attr("alt", image_alt);
        $(".image-preview").css("display", "block");
        $(".image-preview > .container").css("display", "flex");
    });

    $(".image-preview > .container > button").on("click", function () {
        $(".image-preview").css("display", "none");
    });


    // OOTD PAGE BUTTON FILTERS
    $(".ootd > .container > .filters > button").on("click", function () {
        if($(this).attr("data-filter") == "all") {
            $(".ootd > .container > .ootd-posts > a").css("display", "block");
        } else {
            $("[data-weather='"+ $(this).attr("data-filter") +"']").css("display", "block");
            $(".ootd > .container > .ootd-posts > a").not("[data-weather='"+ $(this).attr("data-filter") +"']").css("display", "none");
        }
    });

    // OOTD PAGE CLICK PREVIEW
    $("main > .ootd > .container > .ootd-posts > a > figure").on("click", function () {
        let image_source = $(this).find("img").attr("src");
        let image_alt = $(this).find("img").attr("alt");
        $(".preview-image").attr("src", image_source);
        $(".preview-image").attr("alt", image_alt);
        $(".image-preview").css("display", "block");
        $(".image-preview > .container").css("display", "flex");
    });
});