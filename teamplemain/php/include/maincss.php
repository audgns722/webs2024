<link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <style>

        .slider {
            position: relative;
            height: 100vh;
            background: #777;
            overflow: hidden;
        }

        .slider__wrap {
            position: absolute;
            width: 100vw;
            height: 100vh;
            transform: translateX(100vw);
            top: 0%;
            left: 0;
            right: auto;
            overflow: hidden;
            transition: transform 450ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
            transform-origin: 0% 50%;
            transition-delay: 450ms;
            opacity: 0;
        }

        .slider__wrap--hacked {
            opacity: 1;
        }

        .slider__back {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: auto 100%;
            background-position: center;
            background-repeat: none;
            transition: filter 450ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        .slider__inner {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0%;
            background-size: auto 133.3333%;
            background-position: center;
            background-repeat: none;
            transform: scale(0.75);
            transition: transform 450ms cubic-bezier(0.785, 0.135, 0.15, 0.86), box-shadow 450ms cubic-bezier(0.785, 0.135, 0.15, 0.86), opacity 450ms step-end;
            opacity: 0;
            box-shadow: 0 3vh 3vh rgba(0, 0, 0, 0);
            padding: 15vh;
            box-sizing: border-box;
        }

        .slider__content {
            position: relative;
            top: 50%;
            width: auto;
            transform: translateY(-50%);
            color: white;
            font-family: "Heebo", sans-serif;
            opacity: 0;
            transition: opacity 450ms;
        }

        .slider__content h1 {
            font-family: 'Jalnan';
            font-weight: 500;
            font-size: 5rem;
            line-height: 1.1;
            margin-bottom: 0.75vh;
            pointer-events: none;
            text-shadow: 0 0.375vh 0.75vh rgba(0, 0, 0, 0.1);
        }

        .slider__content a {
            cursor: pointer;
            font-size: 2.4vh;
            letter-spacing: 0.3vh;
            font-weight: 100;
            position: relative;
        }

        .slider__content a:after {
            content: "";
            display: block;
            width: 9vh;
            background: white;
            height: 1px;
            position: absolute;
            top: 50%;
            left: 6vh;
            transform: translateY(-50%);
            transform-origin: 0% 50%;
            transition: transform 900ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        .slider__content a:before {
            content: "";
            border-top: 1px solid white;
            border-right: 1px solid white;
            display: block;
            width: 1vh;
            height: 1vh;
            transform: translateX(0) translateY(-50%) rotate(45deg);
            position: absolute;
            font-family: "Heebo", sans-serif;
            font-weight: 100;
            top: 50%;
            left: 15vh;
            transition: transform 900ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        .slider__content a:hover:after {
            transform: scaleX(1.5);
            transition: transform 1200ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        .slider__content a:hover:before {
            transform: translateX(6vh) translateY(-50%) rotate(45deg);
            transition: transform 1200ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        .slider__slide {
            position: absolute;
            left: 0;
            height: 100vh;
            width: 100vw;
            transition: transform 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
            transition-delay: 600ms;
            pointer-events: none;
            z-index: 0;
        }

        .slider__slide--active {
            transform: translatex(0%);
            z-index: 2;
        }

        .slider__slide--active .slider__wrap {
            transform: translateX(0);
            transform-origin: 100% 50%;
            opacity: 1;
            -webkit-animation: none;
            animation: none;
        }

        .slider__slide--active .slider__back {
            filter: blur(1.5vh);
            transition: filter 900ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
            transition-delay: 900ms !important;
        }

        .slider__slide--active .slider__inner {
            transform: scale(0.8);
            box-shadow: 0 1vh 6vh rgba(0, 0, 0, 0.2);
            pointer-events: auto;
            opacity: 1;
            transition: transform 900ms cubic-bezier(0.785, 0.135, 0.15, 0.86), box-shadow 900ms cubic-bezier(0.785, 0.135, 0.15, 0.86), opacity 1ms step-end;
            transition-delay: 900ms;
        }

        .slider__slide--active .slider__content {
            opacity: 1;
            transition-delay: 1350ms;
        }

        .slider__slide:not(.slider__slide--active) .slider__wrap {
            -webkit-animation-name: hack;
            animation-name: hack;
            -webkit-animation-duration: 900ms;
            animation-duration: 900ms;
            -webkit-animation-delay: 450ms;
            animation-delay: 450ms;
            -webkit-animation-timing-function: cubic-bezier(0.785, 0.135, 0.15, 0.86);
            animation-timing-function: cubic-bezier(0.785, 0.135, 0.15, 0.86);
        }

        @-webkit-keyframes hack {
            0% {
                transform: translateX(0);
                opacity: 1;
            }

            50% {
                transform: translateX(-100vw);
                opacity: 1;
            }

            51% {
                transform: translateX(-100vw);
                opacity: 0;
            }

            52% {
                transform: translateX(100vw);
                opacity: 0;
            }

            100% {
                transform: translateX(100vw);
                opacity: 1;
            }
        }

        @keyframes hack {
            0% {
                transform: translateX(0);
                opacity: 1;
            }

            50% {
                transform: translateX(-100vw);
                opacity: 1;
            }

            51% {
                transform: translateX(-100vw);
                opacity: 0;
            }

            52% {
                transform: translateX(100vw);
                opacity: 0;
            }

            100% {
                transform: translateX(100vw);
                opacity: 1;
            }
        }

        .slider__slide:nth-child(1) .slider__back,
        .slider__slide:nth-child(1) .slider__inner {
            background-image: url(../../assets/img/sliderimg02.jpg);
        }

        .slider__slide:nth-child(2) .slider__back,
        .slider__slide:nth-child(2) .slider__inner {
            background-image: url(../../assets/img/sliderimg03.jpg);
        }

        .slider__slide:nth-child(3) .slider__back,
        .slider__slide:nth-child(3) .slider__inner {
            background-image: url(../../assets/img/sliderimg05.jpg);
        }

        .sig {
            position: fixed;
            bottom: 8px;
            right: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 100;
            font-family: sans-serif;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 2px;
            z-index: 9999;
        }

        .pauseButton {
            margin-left: 6rem;
            display: inline-block;
            background-image: url(../../assets/img/stop.svg);
            width: 25px;
            height: 25px;
            z-index: 1000;
            background-size: cover;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.753);
            border-radius: 50%;
            border: 1px solid var(--black200);
            transition: all 0.3s;
        }

        .pauseButton:hover {
            transform: scale(1.5);
            background-color: #fff;
        }

        .resumeButton {
            margin-left: 1rem;
            display: inline-block;
            background-image: url(../../assets/img/play.svg);
            width: 25px;
            height: 25px;
            z-index: 1000;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.753);
            border-radius: 50%;
            border: 1px solid var(--black400);
            cursor: pointer;
            transition: all 0.3s;
        }

        .resumeButton svg {}

        .resumeButton:hover {
            transform: scale(1.5);
            background-color: #fff;
        }

        #tagWrap {
            height: 650px;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            flex-direction: column;
            margin-bottom: 100px;
        }

        .intro__inner {
            width: 100%;
            height: 920px;
            padding: 75px 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .intro__text h3 {
            text-align: center;
        }

        @media (max-width:660px) {
            .slider__content h1 {
                font-size: 2rem;
            }

            .pauseButton {
                margin-left: 1rem;
            }
        }
    </style>