$(function(){
    // 이미지 슬라이드
    let currentIndex = 0; //현재 이미지 설정
    $(".imageWrap").append($(".image").first().clone(true));    // 첫번째 이미지를 복사해서 마지막에 추가

    setInterval(() => {     //3초에 한번씩 실행
        currentIndex++;     //현재 이미지를 1씩 증가
        $(".imageWrap").animate({marginTop:-400 * currentIndex + "px"}, 600);

        if(currentIndex==3 ){   // 마지막 이지미
            setTimeout(()=> {
                $(".imageWrap").animate({marginTop:0}, 0);      //애니메이션 정지
                currentIndex = 0;
            }, 600);
        }
    }, 3000);

    // 메뉴
    $(".nav > ul > li").mouseover(function(){
        $(this).find(".submenu").stop().slideDown(300);
    });
    $(".nav > ul > li").mouseout(function(){
        $(this).find(".submenu").stop().slideUp(100);
    });

    // 팝업
    $(".popup__btn").click(function(){
        $(".popup__view").show();
    });
    $(".popup__close").click(function(){
        $(".popup__view").hide();
    });
});