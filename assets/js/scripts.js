$(document).ready(function () {
    // NAVIGATION
    $(document).on("mouseover", ".drop-down", function () {
        $(this).find("ul").css("visibility", "visible");
    });

    $(document).on("mouseout", ".drop-down, .drop-down>ul, .drop-down>ul>li, .drop-down>ul>li>a", function () {
        $(this).find("ul").css("visibility", "hidden");
    });

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
    $(document).on("mouseover", "main > .travel > .container > .travel-posts > article", function() {
        $(this).find("figure > figcaption").css("margin", "-50px 0 0px");
        $(this).find("figure > img").css("filter", "brightness(70%)");
        $(this).find("figure > .overlay").css("opacity", "1");
        $(this).find("figure > .overlay > span").css("padding-right", "10px");
    });

    $(document).on("mouseleave", "main > .travel > .container > .travel-posts > article", function() {
        $(this).find("figure > figcaption").css("margin", "-28px 0 0px");
        $(this).find("figure > img").css("filter", "brightness(100%)");
        $(this).find("figure > .overlay").css("opacity", "0");
        $(this).find("figure > .overlay > span").css("padding-right", "0px");
    });

    // BLOG INDEX HOVER EFFECT
    $(document).on("mouseover", ".blog-posts > article", function () {
        $(this).find("a > figure > img").css("filter", "brightness(70%)");
        $(this).find("a > figure > .overlay").css("opacity", "1");
        $(this).find("a > figure > .overlay > span").css("padding-right", "10px");
    });

    $(document).on("mouseleave", ".blog-posts > article", function () {
        $(this).find("a > figure > img").css("filter", "brightness(100%)");
        $(this).find("a > figure > .overlay").css("opacity", "0");
        $(this).find("a > figure > .overlay > span").css("padding-right", "0px");
    });

    // BLOG PAGE HOVER EFFECT
    $(document).on("mouseover", "main > .blog > .container > .blog-posts > a", function () {
        $(this).find("img").css("margin-left", "20px");
    });

    $(document).on("mouseleave", "main > .blog > .container > .blog-posts > a", function () {
        $(this).find("img").css("margin-left", "10px");
    });

    // BLOG PAGE BUTTON FILTERS
    $(document).on("click", ".blog > .container > .filters > button", function () {
        if($(this).attr("data-filter") == "all") {
            $(".blog > .container > .blog-posts > article").css("display", "block");
        } else {
            $("[data-category='"+ $(this).attr("data-filter") +"']").css("display", "block");
            $(".blog > .container > .blog-posts > article").not("[data-category='"+ $(this).attr("data-filter") +"']").css("display", "none");
        }
    });

    // BLOG PAGE INPUT KEYWORD FILTER
    $(document).on("keyup", ".blog > .container > input", function () {
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
    $(document).on("mouseover", "main > .travel > .travel-images > a", function () {
        $(this).find("img").css("margin-left", "20px");
    });

    $(document).on("mouseleave", "main > .travel > .travel-images > a", function () {
        $(this).find("img").css("margin-left", "10px");
    });

    // TRAVEL PAGE BUTTON FILTERS
    $(document).on("click", ".travel > .container > .filters > button", function () {
        if($(this).attr("data-filter") == "all") {
            $(".travel > .container > .travel-posts > article").css("display", "block");
        } else {
            $("[data-type='"+ $(this).attr("data-filter") +"']").css("display", "block");
            $(".travel > .container > .travel-posts > article").not("[data-type='"+ $(this).attr("data-filter") +"']").css("display", "none");
        }
    });

    // TRAVEL PAGE INPUT KEYWORD FILTER
    $(document).on("keyup", ".travel > .container > input", function () {
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
    $(document).on("mouseover", "main > .ootd > .container > .ootd-container > figure", function () {
        $(this).find("img").css("filter", "brightness(70%)");
    });

    $(document).on("mouseleave", "main > .ootd > .container > .ootd-container > figure", function () {
        $(this).find("img").css("filter", "brightness(100%)");
    });

    // OOTD INDEX CLICK PREVIEW
    $(document).on("click", "main > .ootd > .container > .ootd-container > figure", function () {
        let image_source = $(this).find("img").attr("src");
        let image_alt = $(this).find("img").attr("alt");
        $(".preview-image").attr("src", image_source);
        $(".preview-image").attr("alt", image_alt);
        $(".image-preview").css("display", "block");
        $(".image-preview > .container").css("display", "flex");
    });

    $(document).on("click", ".image-preview > .container > button", function () {
        $(".image-preview").css("display", "none");
    });


    // OOTD PAGE BUTTON FILTERS
    $(document).on("click", ".ootd > .container > .filters > button", function () {
        if($(this).attr("data-filter") == "all") {
            $(".ootd > .container > .ootd-posts > a").css("display", "block");
        } else {
            $("[data-weather='"+ $(this).attr("data-filter") +"']").css("display", "block");
            $(".ootd > .container > .ootd-posts > a").not("[data-weather='"+ $(this).attr("data-filter") +"']").css("display", "none");
        }
    });

    // OOTD PAGE CLICK PREVIEW
    $(document).on("click", "main > .ootd > .container > .ootd-posts > a > figure", function () {
        let image_source = $(this).find("img").attr("src");
        let image_alt = $(this).find("img").attr("alt");
        $(".preview-image").attr("src", image_source);
        $(".preview-image").attr("alt", image_alt);
        $(".image-preview").css("display", "block");
        $(".image-preview > .container").css("display", "flex");
    });
});