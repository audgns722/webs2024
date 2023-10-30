$(function(){
    $(".aside__nav > ul > li").mouseover(function(){
        $(this).find(".submenu").stop().slideDown();
    });
    $(".aside__nav > ul > li").mouseout(function(){
        $(this).find(".submenu").stop().slideUp();
    });


});