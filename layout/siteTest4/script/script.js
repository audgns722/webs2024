$(function () {
    $("#aside .nav > ul > li").mouseover(function () {
        $(this).find(".submenu").stop().slideDown(300);
    })
    $("#aside .nav > ul > li").mouseout(function () {
        $(this).find(".submenu").stop().slideUp(0);
    });

    let currentIndex = 0;
    $(".slider__wrap").append($(".slider").first().clone(true));

    setInterval(() => {
        currentIndex++;

        $(".slider__wrap").animate({ marginTop: -800 * currentIndex }, 600);

        if (currentIndex == 3) {
            setTimeout(() => {
                $(".slider__wrap").animate({ marginTop: 0 }, 0);
                currentIndex = 0;
            }, 700);
        }
    }, 3000);

    $(".popup__close").click(function () {
        $(".popup__box").hide();
    });
    $(".popup__view").click(function () {
        $(".popup__box").show();
    });

})