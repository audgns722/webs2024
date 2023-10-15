$(function(){
    //이미지 슬라이드
    let currentIndex =0; //현재 이미지
    $(".sliderWrap").append($(".slider").first().clone(true));

    setInterval(() => {
        currentIndex++;     //현재 이미지 1씩 증가
        $(".sliderWrap").animate({marginLeft: -1200 * currentIndex}, 600);

        if(currentIndex == 3) {
            setTimeout(() => {
                $(".sliderWrap").animate({marginLeft:0}, 0);
                currentIndex = 0;
            }, 700);
        }
    }, 3000);

    // 메뉴
    $(".nav > ul > li").mouseover(function(){
        $(".nav > ul > li > ul").stop().fadeIn(400);
        $("#header .container").addClass("on");
    });
    $(".nav > ul > li").mouseout(function(){
        $(".nav > ul > li > ul").stop().fadeOut(100);
        $("#header .container").removeClass("on");
    });

    // 팝업
    $(".popup__btn").click(function(){
        $(".popup__view").show();
    });
    $(".popup__close").click(function(){
        $(".popup__view").hide();
    });
})