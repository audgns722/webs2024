$(function () {
    let currentIndex = 0;
    $(".slider__wrap").append($(".slider").first().clone(true));

    setInterval(() => {
        currentIndex++;

        $(".slider__wrap").animate({ marginTop: -400 * currentIndex }, 600);

        if (currentIndex == 3) {
            setTimeout(() => {
                $(".slider__wrap").animate({ marginTop: 0 }, 0);
                currentIndex = 0;
            }, 700);
        }
    }, 3000);

    $(".nav > ul > li").mouseover(function () {
        $(this).find(".submenu").stop().slideDown(300);
    })
    $(".nav > ul > li").mouseout(function () {
        $(this).find(".submenu").stop().slideUp(0);
    });

    $(".content__title .con__notice").click(function () {
        $(".content .notice").show();
        $(".content .gallery").hide();
    })
    $(".content__title .con__gallery").click(function () {
        $(".content .notice").hide();
        $(".content .gallery").show();
    })
})