$(function(){
    // 이미지 슬라이드
    let currentIndex = 0;
    $(".sliderWrap").append($(".slider").first().clone(true));

    setInterval(() => {
        currentIndex++;
        $(".sliderWrap").animate({marginLeft : -100 * currentIndex + "%"}, 600);

        if(currentIndex== 3){
            setTimeout(() => {
                $(".sliderWrap").animate({marginLeft:0},0);
                currentIndex = 0;
            }, 600);
        }
    }, 3000);

    //메뉴
    $(".nav > ul > li").mouseover(function(){
        $(this).find(".submenu").stop().slideDown();
    });
    $(".nav > ul > li").mouseout(function(){
        $(this).find(".submenu").stop().slideUp();
    });

    //팝업
    $(".popup__btn").click(function(){
        $(".popup__view").show();
    });
    $(".popup__close").click(function(){
        $(".popup__view").hide();
    });
});