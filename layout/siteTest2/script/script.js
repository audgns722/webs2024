$(function(){
    $(".nav > ul > li").mouseover(function(){
        $(this).find(".submenu").stop().slideDown(300);
    });
    $(".nav > ul > li").mouseout(function(){
        $(this).find(".submenu").stop().slideUp(200);
    });

    const tabBtn = $(".notice > a");
    const tabCont = $(".notice > div");

    tabCont.hide().eq(0).show();

    tabBtn.click(function(){
        const index = $(this).index();

        $(this).addClass("active").siblings().removeClass("active");
        tabCont.eq(index).show().siblings().hide();      
    });

    let currentIndex = 0; 
    setInterval(() => {
        let nextIndex = (currentIndex + 1) % 3;

        $(".slider").eq(currentIndex).fadeOut(1200);
        $(".slider").eq(nextIndex).fadeIn(1200);

        currentIndex = nextIndex;

    }, 3000);

    $(".popup__close").click(function(){
        $(".popup__box").hide();
    });
    $(".popup__view").click(function(){
        $(".popup__box").show();
    });
});