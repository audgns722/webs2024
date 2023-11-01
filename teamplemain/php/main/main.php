<?php
include "../connect/connect.php";
include "../connect/session.php";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <?php include "../include/maincss.php" ?>
<style>
    /* .flip-card-container */
.flip-card-container {
  --hue: 150;
  --primary: hsl(var(--hue), 50%, 50%);
  --white-1: hsl(0, 0%, 90%);
  --white-2: hsl(0, 0%, 80%);
  --dark: hsl(var(--hue), 25%, 10%);
  --grey: hsl(0, 0%, 50%);

  display: flex;
  justify-content: center;
  width: 80%;
  height: 500px;
  perspective: 1000px;
}

/* .flip-card */
.flip-card {
  width: inherit;
  height: inherit;

  position: relative;
  transform-style: preserve-3d;
  transition: .6s .1s;
}

/* hover and focus-within states */
.flip-card-container:hover .flip-card,
.flip-card-container:focus-within .flip-card {
  transform: rotateY(180deg);
}

/* .card-... */
.card-front,
.card-back {
  width: 100%;
  height: 100%;
  border-radius: 24px;

  background: var(--dark);
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;

  backface-visibility: hidden;

  display: flex;
  justify-content: center;
  align-items: center;
}

/* .card-front */
.card-front {
  transform: rotateY(0deg);
  z-index: 2;
}

/* .card-back */
.card-back {
  transform: rotateY(180deg);
  z-index: 1;
}

/* figure */
figure {
  z-index: -1;
}

/* figure, .img-bg */
figure,
.img-bg {
  position: absolute;
  top: 0;
  left: 0;

  width: 100%;
  height: 100%;
}

/* img */
img {
  height: 100%;
  border-radius: 24px;
}

/* figcaption */
figcaption {
  display: block;

  width: auto;
  margin-top: 12%;
  padding: 8px 22px;

  font-weight: bold;
  line-height: 1.6;
  letter-spacing: 2px;
  word-spacing: 6px;
  text-align: right;

  position: absolute;
  top: 0;
  right: 12px;

  color: var(--white-1);
  background: hsla(var(--hue), 25%, 10%, .5);
}

/* .img-bg */
.img-bg {
  background: hsla(var(--hue), 25%, 10%, .5);
}

.card-front .img-bg {
  clip-path: polygon(0 20%, 100% 40%, 100% 100%, 0 100%);
}

.card-front .img-bg::before {
  content: "";

  position: absolute;
  top: 34%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(18deg);

  width: 100%;
  height: 6px;
  border: 1px solid var(--primary);
  border-left-color: transparent;
  border-right-color: transparent;

  transition: .1s;
}

.card-back .img-bg {
  clip-path: polygon(0 0, 100% 0, 100% 80%, 0 60%);
}

/* hover state */
.flip-card-container:hover .card-front .img-bg::before {
  width: 6px;
  border-left-color: var(--primary);
  border-right-color: var(--primary);
}

/* ul */
.card-front > ul {
  padding-top: 50%;
  margin: 0 auto;
  width: 70%;
  height: 100%;

  list-style: none;
  color: var(--white-1);

  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

/* li */
.card-front > li {
  width: 100%;
  margin-top: 12px;
  padding-bottom: 12px;

  font-size: 14px;
  text-align: center;

  position: relative;
}

.card-front > li:nth-child(2n) {
  color: var(--white-2);
}

.card-front > li:not(:last-child)::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 1px;
  background: currentColor;
  opacity: .2;
}

/* button */
button {
  font-family: inherit;
  font-weight: bold;
  color: var(--white-1);
  letter-spacing: 2px;
  padding: 9px 20px;
  border: 1px solid var(--grey);
  border-radius: 1000px;
  background: transparent;
  transition: .3s;
  cursor: pointer;
}

button:hover,
button:focus {
  color: var(--primary);
  background: hsla(var(--hue), 25%, 10%, .2);
  border-color: currentColor;
}

button:active {
  transform: translate(2px);
}

/* .design-container */
.design-container {
  --tr: 90;
  --op: .5;

  width: 100%;
  height: 100%;

  background: transparent;
  position: absolute;
  top: 0;
  left: 0;

  pointer-events: none;
}

/* .design */
.design {
  display: block;

  background: var(--grey);
  position: absolute;

  opacity: var(--op);
  transition: .3s;
}

.design--1,
.design--2,
.design--3,
.design--4 {
  width: 1px;
  height: 100%;
}

.design--1,
.design--2 {
  top: 0;
  transform: translateY(calc((var(--tr) - (var(--tr) * 2)) * 1%))
}

.design--1 {
  left: 20%;
}

.design--2 {
  left: 80%;
}

.design--3,
.design--4 {
  bottom: 0;
  transform: translateY(calc((var(--tr) + (var(--tr) - var(--tr))) * 1%))
}

.design--3 {
  left: 24%;
}

.design--4 {
  left: 76%;
}

.design--5,
.design--6,
.design--7,
.design--8 {
  width: 100%;
  height: 1px;
}

.design--5,
.design--6 {
  left: 0;
  transform: translateX(calc((var(--tr) - (var(--tr) * 2)) * 1%));
}

.design--5 {
  top: 41%;
}

.design--6 {
  top: 59%;
}

.design--7,
.design--8 {
  right: 0;
  transform: translateX(calc((var(--tr) + (var(--tr) - var(--tr))) * 1%))
}

.design--7 {
  top: 44%;
}

.design--8 {
  top: 56%;
}
.card-back > img {
    width: 100px;
    height: 100px;
    opacity: 0.5;
}

/* states */
button:hover+.design-container,
button:active+.design-container,
button:focus+.design-container {
  --tr: 20;
  --op: .7;
}

/* .abs-site-link {
  position: fixed;
  bottom: 20px;
  left: 20px;
  color: hsla(0, 0%, 100%, .6);
  font-size: 16px;
  font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
} */
</style>
</head>

<body>
    <?php include "../include/header.php" ?>
    <!-- //header -->

    <main id="main">
        <div class="slider">
            <div class="slider__slide slider__slide--active" data-slide="1">
                <div class="slider__wrap">
                    <div class="slider__back"></div>
                </div>
                <div class="slider__inner">
                    <div class="slider__content">
                        <h1>환경을 <br> 생각하고</h1><a class="go-to-next">next</a><br>
                        <div class="pauseButton"></div>
                        <div class="resumeButton"></div>
                    </div>
                </div>
            </div>
            <div class="slider__slide" data-slide="2">
                <div class="slider__wrap">
                    <div class="slider__back"></div>
                </div>
                <div class="slider__inner">
                    <div class="slider__content">
                        <div class="slider__content">
                            <h1>지구를 <br> 살리고</h1><a class="go-to-next">next</a><br>
                            <div class="pauseButton"></div>
                            <div class="resumeButton"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider__slide" data-slide="3">
                <div class="slider__wrap">
                    <div class="slider__back"></div>
                </div>
                <div class="slider__inner">
                    <div class="slider__content">
                        <div class="slider__content">
                            <h1>더나은 <br> 미래를 만든다</h1><a class="go-to-next">next</a><br>
                            <div class="pauseButton"></div>
                            <div class="resumeButton"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider__indicators"></div>
        </div>

        <div class="intro__inner">
            <div class="introWrap container">
                <div class="intro__text">
                    <h3>이번주 BEST 이슈</h3>
                    <p>이번주 가장 인기 있는 품목을 모아보아요.</p>
                </div>
                <section class="hero-section">
                    <div class="card-grid">
                        <a class="card" href="#">
                            <div class="card__background"
                                style="background-image: url(../../assets/img/intro__inner01.jpg)"></div>
                            <div class="card__content">
                                <p class="card__category">Category</p>
                                <h3 class="card__heading">대형가구</h3>
                            </div>
                        </a>
                        <a class="card" href="#">
                            <div class="card__background"
                                style="background-image: url(../../assets/img/intro__inner02.jpg)"></div>
                            <div class="card__content">
                                <p class="card__category">Category</p>
                                <h3 class="card__heading">중형가구</h3>
                            </div>
                        </a>
                        <a class="card" href="#">
                            <div class="card__background"
                                style="background-image: url(../../assets/img/intro__inner03.jpg)"></div>
                            <div class="card__content">
                                <p class="card__category">Category</p>
                                <h3 class="card__heading">중형가구</h3>
                            </div>
                        </a>
                        <a class="card" href="#">
                            <div class="card__background"
                                style="background-image: url(../../assets/img/intro__inner04.jpg)"></div>
                            <div class="card__content">
                                <p class="card__category">Category</p>
                                <h3 class="card__heading">소형가구</h3>
                            </div>
                        </a>
                        <div>
                </section>
            </div>
        </div>

        <div class="company__inner container">
            <div class="flip-card-container" style="--hue: 220">
                <div class="flip-card">
                    <div class="card-front">
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="Brohm Lake">
                            <figcaption>Think</figcaption>
                        </figure>
                        <ul>
                            <li>지구를 생각하고</li>
                        </ul>
                    </div>
                    <div class="card-back">
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="Brohm Lake">
                        </figure>
                        <img src="../../assets/img/Think.png" alt="">
                        <div class="design-container">
                            <span class="design design--1"></span>
                            <span class="design design--2"></span>
                            <span class="design design--3"></span>
                            <span class="design design--4"></span>
                            <span class="design design--5"></span>
                            <span class="design design--6"></span>
                            <span class="design design--7"></span>
                            <span class="design design--8"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /flip-card-container -->

            <!-- flip-card-container -->
            <div class="flip-card-container" style="--hue: 170">
                <div class="flip-card">
                    <div class="card-front">
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1545436864-cd9bdd1ddebc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="Image 2">
                            <figcaption>Reuse</figcaption>
                        </figure>
                        <ul>
                            <li>한번 더 사용하고</li>
                        </ul>
                    </div>
                    <div class="card-back">
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1545436864-cd9bdd1ddebc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="image-2">
                        </figure>
                        <img src="../../assets/img/reuse.png" alt="">
                        <div class="design-container">
                            <span class="design design--1"></span>
                            <span class="design design--2"></span>
                            <span class="design design--3"></span>
                            <span class="design design--4"></span>
                            <span class="design design--5"></span>
                            <span class="design design--6"></span>
                            <span class="design design--7"></span>
                            <span class="design design--8"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /flip-card-container -->

            <!-- flip-card-container -->
            <div class="flip-card-container" style="--hue: 350">
                <div class="flip-card">
                    <div class="card-front">
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="Brohm Lake">
                            <figcaption>Recycle</figcaption>
                        </figure>
                        <ul>
                            <li>올바르게 재활용하고</li>
                        </ul>
                    </div>
                    <div class="card-back">
                        <!-- only if the image is necessary -->
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="Brohm Lake">
                        </figure>
                        <img src="../../assets/img/recycle.png" alt="">
                        <!-- can add svg here and remove these eight spans -->
                        <div class="design-container">
                            <span class="design design--1"></span>
                            <span class="design design--2"></span>
                            <span class="design design--3"></span>
                            <span class="design design--4"></span>
                            <span class="design design--5"></span>
                            <span class="design design--6"></span>
                            <span class="design design--7"></span>
                            <span class="design design--8"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /flip-card-container -->

            <!-- flip-card-container -->
            <div class="flip-card-container" style="--hue: 300">
                <div class="flip-card">
                    <div class="card-front">
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="Brohm Lake">
                            <figcaption>Recovery</figcaption>
                        </figure>
                        <ul>
                            <li>지구의 에너지를 만들고!</li>
                        </ul>
                    </div>
                    <div class="card-back">
                        <!-- only if the image is necessary -->
                        <figure>
                            <div class="img-bg"></div>
                            <img src="https://images.unsplash.com/photo-1486162928267-e6274cb3106f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                alt="Brohm Lake">
                        </figure>
                        <img src="../../assets/img/Recovery.png" alt="">
                        <!-- can add svg here and remove these eight spans -->
                        <div class="design-container">
                            <span class="design design--1"></span>
                            <span class="design design--2"></span>
                            <span class="design design--3"></span>
                            <span class="design design--4"></span>
                            <span class="design design--5"></span>
                            <span class="design design--6"></span>
                            <span class="design design--7"></span>
                            <span class="design design--8"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /flip-card-container -->

            <!-- <div class="company__title">
                <h3>소소한 나의 실천으로 함께 만들어가는 깨끗한 지구!</h3>
            </div>
            <div class="page2Wrap">
                <div class="companyimgWrap">
                    <div class="company__img">
                        <img src="../../assets/img/com11.png" alt="">
                        <h2>Think</h2>
                        <p>지구를 생각하고</p>
                    </div>
                    <div class="company__img">
                        <img src="../../assets/img/com12.png" alt="">
                        <h2>Reuse</h2>
                        <p>한번 더 사용하고</p>
                    </div>
                    <div class="company__img">
                        <img src="../../assets/img/com13.png" alt="">
                        <h2>Recycle</h2>
                        <p>올바르게 재활용하고</p>
                    </div>
                    <div class="company__img">
                        <img src="../../assets/img/com14.png" alt="">
                        <h2>Recovery</h2>
                        <p>지구의 에너지를 만들고!</p>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="main__page3">
            <div class="page3__text">
                <h4>자원 순환을 위해 앞장서는 기업</h4>
                <p>기업의 다양한 친환경 활동을 소개합니다.</p>
            </div>
            <div class="companyWrap">
                <div class="companyBox">
                    <div class="dunkin"></div>
                    <div class="company__text">
                        친환경 포장재 전환<br>
                        <em>11,504,919 개</em>
                    </div>
                    <div class="company__result">
                        <div class="result1">
                            <img src="../../assets/img/result1.png">
                            <h4>
                                1,515그루<br>
                                소나무 심은 효과
                            </h4>
                        </div>
                        <span>=</span>
                        <div class="result2">
                            <img src="../../assets/img/result2.png">
                            <h4>
                                13,771kg<br>
                                탄소저감량
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="companyBox">
                    <div class="nature"></div>
                    <div class="company__text">
                        패트병 생수 절감<br>
                        <em>170,013,808 개</em>
                    </div>
                    <div class="company__result">
                        <div class="result1">
                            <img src="../../assets/img/result1.png">
                            <h4>
                                20,893그루<br>
                                소나무 심은 효과
                            </h4>
                        </div>
                        <span>=</span>
                        <div class="result2">
                            <img src="../../assets/img/result2.png">
                            <h4>
                                189,939kg<br>
                                탄소저감량
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="companyBox">
                    <div class="starbucks"></div>
                    <div class="company__text">
                        텀블러 사용하기<br>
                        <em>98,994,105 건</em>
                    </div>
                    <div class="company__result">
                        <div class="result1">
                            <img src="../../assets/img/result1.png">
                            <h4>
                                12,166그루<br>
                                소나무 심은 효과
                            </h4>
                        </div>
                        <span>=</span>
                        <div class="result2">
                            <img src="../../assets/img/result2.png">
                            <h4>
                                110,596kg<br>
                                탄소저감량
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="companyBox">
                    <div class="baemin"></div>
                    <div class="company__text">
                        일회용품 덜쓰기<br>
                        <em>17,296,352 명</em>
                    </div>
                    <div class="company__result">
                        <div class="result1">
                            <img src="../../assets/img/result1.png">
                            <h4>
                                1,515그루<br>
                                소나무 심은 효과
                            </h4>
                        </div>
                        <span>=</span>
                        <div class="result2">
                            <img src="../../assets/img/result2.png">
                            <h4>
                                13,771kg<br>
                                탄소저감량
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="tagWrap">
            <div class="tag__title">
                <h1>카테고리별 쓰레기</h1>
                <p>다양한 카테고리로 원하는 제품을 찾아보세요.</p>
            </div>
            <div class="tag__inner scroll style">
                <div class="tagimgBox">
                    <img src="../../assets/img/fashion01.jpg" alt="img1">
                    <h3>가구</h3>
                    <p>대형생활폐기물 원목,합판,시트지 등의 <br>
                        재질로 제작되어 재활용이 불가능<br>
                        신고 및 수거는 <br>유료 2,000 ~ 10,000원 가량 부과
                    </p>
                </div>
                <div class="tagimgBox">
                    <img src="../../assets/img/furniture1.jpg" alt="img2">
                    <h3>패션</h3>
                    <p>대형생활폐기물 원목,합판,시트지 등의 <br>
                        재질로 제작되어 재활용이 불가능<br>
                        신고 및 수거는 <br>유료 2,000 ~ 10,000원 가량 부과
                    </p>
                </div>
                <div class="tagimgBox">
                    <img src="../../assets/img/plastic01.jpg" alt="img3">
                    <h3>용기</h3>
                    <p>대형생활폐기물 원목,합판,시트지 등의<br>
                        재질로 제작되어 재활용이 불가능<br>
                        신고 및 수거는 <br>유료 2,000 ~ 10,000원 가량 부과
                    </p>
                </div>
                <div class="tagimgBox">
                    <img src="../../assets/img/plastic01.jpg" alt="img4">
                    <h3>용기</h3>
                    <p>대형생활폐기물 원목,합판,시트지 등의<br>
                        재질로 제작되어 재활용이 불가능<br>
                        신고 및 수거는 <br>유료 2,000 ~ 10,000원 가량 부과
                    </p>
                </div>
                <div class="tagimgBox">
                    <img src="../../assets/img/jewelry.jpg" alt="img5">
                    <h3>주얼리</h3>
                    <p>대형생활폐기물 원목,합판,시트지 등의<br>
                        재질로 제작되어 재활용이 불가능<br>
                        신고 및 수거는 <br>유료 2,000 ~ 10,000원 가량 부과
                    </p>
                </div>
            </div>
        </section>

    </main>

    <footer id="footer" role="contentinfo">
        <div class="footer__inner">
            <div class="footerwrap">
                <ul>
                    <li><img src="../../assets/img/logo2.jpg" alt="sitelogo"></li>
                    <li>
                        <h2>CUSTOMER CENTER</h2>
                        <p>전화보다 빠른 궁금증 해결</p>
                    </li>
                    <li>
                        <h2>NOTICE +</h2>
                        <p>종량제 봉투 가격 인상 공지<br>
                            2025 대기업 탄소 저감 실적 의무화 실시예정</p>
                    </li>
                    <li>
                        <h2>about 분리배출</h2>
                        <p>주소 : 서울특별시 구로구 구로동 237-14<br>
                            통신판매업 신고 : 2015-서울구로-1525</p>
                    </li>
                    <li>
                        <div class="footer__sns">
                            <h1>SOCIAL</h1>
                            <div>
                                <img src="../../assets/img/Facebook.png" alt="Facebook">
                                <img src="../../assets/img/Instagram.png" alt="Instagram">
                                <img src="../../assets/img/messanger.png" alt="messanger">
                                <a href="/teamplemain/index2.html"><img src="../../assets/img/Whatsapp.png"
                                        alt="Whatsapp"></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </footer>


    <?php include "../include/mainjs.php" ?>
    <!-- //script -->
</body>

</html>