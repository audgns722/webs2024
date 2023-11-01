<?php
    if(isset($_GET['category'])){
        $category = $_GET['category'];
    }
?>
<header id="header">
    <a class="header__logo" href="../main/main.php"><img src="../../assets/img/logo2.jpg" alt="사이트로고"></a>
    <a class="headerLogo__icon" href='../main/main.php'><img src="../../assets/img/logoicon.svg" alt="홈"></a>
    <div id="sidenav" class="sidenav">
        <div id="slidebtn" class="slideBtn"> &#9776; </div>
        <div id="close" class="close" onclick="closeNav()">☓</div>
        <div class="menu">
            <a href="#">분리배출</a>
            <a href="#"><p>가구</p></a>
            <a href="#"><p>가전</p></a>
            <a href="#"><p>용기포장</p></a>
            <a href="#"><p>패션잡화</p></a>
            <a href="#"><p>음식물</p></a>
            <a href="#"><p>기타</p></a>
            <a href="#">탄소발자국</a>
            <a href="../board/boardCate.php?category=공지사항">커뮤니티</a>
            <a href="../board/boardCate.php?category=공지사항"><p>공지사항</p></a>
            <a href="../board/boardCate.php?category=질문하기"><p>질문하기</p></a>
            <a href="../board/boardCate.php?category=문의하기"><p>문의하기</p></a>
            <a href="#">만든사람들</a>
        </div>
    </div>
    <nav class="header__nav">
        <ul>
            <li><a href="#">분리배출</a>
                <ul class="submenu">
                    <li><a href="#">가구</a></li>
                    <li><a href="#">가전</a></li>
                    <li><a href="#">용기포장</a></li>
                    <li><a href="#">패션잡화</a></li>
                    <li><a href="#">음식물</a></li>
                    <li><a href="#">기타</a></li>
                </ul>
            </li>
            <li><a href="#">탄소발자국</a>
            </li>
            <li><a href="../board/boardCate.php?category=공지사항">커뮤니티</a>
                <ul class="submenu">
                    <li><a href="../board/boardCate.php?category=공지사항">공지사항</a></li>
                    <li><a href="../board/boardCate.php?category=질문하기">질문하기</a></li>
                    <li><a href="../board/boardCate.php?category=문의사항">1:1 질문</a></li>
                </ul>
            </li>
            <li><a href="#">만든사람들</a>
            </li>
        </ul>
    </nav>


    <div class="header__search">
        <input type="text" placeholder="1. 용기분리배출">
        <div class="search__zoom"></div>
    </div>
    <div class="header__login">
        <?php if (isset($_SESSION['memberId'])) { ?>
            <ul>
                <li class="login__wellcom"><a href="#">
                        <?= $_SESSION['youName'] ?>님
                    </a></li>
                <li class="login__logout"><a href="../login/logout.php">로그아웃</a></li>
            </ul>
        <?php } else { ?>
            <button class="login__btn">
                <a href="../login/login.html"></a><img src="../../assets/img/login.svg" alt="loginicon">
                <a href="../login/login.php">Login</a>
            </button>
        <?php } ?>
    </div>
</header>
<!-- //header -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    // 메뉴 
    window.onload = function () {
            let navList = document.querySelectorAll(".header__nav > ul > li");

            navList.forEach(function (navItem) {
                navItem.addEventListener("mouseover", function () {
                    const submenu = this.querySelector(".submenu");
                    submenu.style.height = submenu.scrollHeight + "px";
                });
            });
            navList.forEach(function (navItem) {
                navItem.addEventListener("mouseout", function () {
                    this.querySelector(".submenu").style.height = "0px";
                });
            });
        };


    //HAMBERGER MENU

    function closeNav() {
    document.getElementById("sidenav").style.width = "0%";
    document.getElementById("slidebtn").style.display = "block";
    }


    $(document).ready(function(){
    $(".slideBtn").click(function(){    
        if($("#sidenav").width() == 0){      
            document.getElementById("sidenav").style.width = "40%";
        
            // document.getElementById("main").style.paddingRight = "250px";
        
            // document.getElementById("slidebtn").style.paddingRight = "0px";
        document.getElementById("slidebtn").style.display = "none";
        }else{
            document.getElementById("sidenav").style.width = "0";
            document.getElementById("main").style.paddingRight = "0";
            document.getElementById("slidebtn").style.paddingRight = "0";
        }
    });
    });
</script>
<!-- //script -->