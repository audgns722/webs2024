<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?> 

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    

</head>
<body>
<?php include "../include/header.php" ?>

    <main id="main">
        <div class="login__inner container">
            <div class="login__wrap">
                <div class="images__wrap">
                    <span></span>
                    <h1>소소한 나의 실천으로<br>
                        함께 만들어가는<br>
                        깨끗한 지구!</h1>
                </div>
                <div class="login__box">
<?php

    $youId = $_POST['youId'];
    $youPass = $_POST['youPass'];
    
    // echo $youId, $youPass;
    
    // 메세지 출력
    function msg($alert){
        echo "<p>$alert</p>";
    }
    
    // 데이터 조회
    // members 데이터 중에 이메일/비밀번호
    $sql = "SELECT memberId, youName, youPass FROM teamMembers WHERE youId = '$youId' AND youPass = '$youPass'";
    $result = $connect -> query($sql);
    
    if($result){
        $count = $result -> num_rows;
    
        if($count == 0){
            msg("이메일 또는 비밀번호가 틀렸습니다. 다시 한번 확인해주세요!");
        } else {
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
        
            // echo "<pre>";
            // var_dump($memberInfo);
            // echo "</pre>";
        
            // 로그인 성공 --> 세션 생성
            $_SESSION['memberId'] = $memberInfo['memberId'];
            // $_SESSION['youEmail'] = $memberInfo['youEmail'];
            $_SESSION['youName'] = $memberInfo['youName'];
        
            echo '<script>window.location.href = "../main/main.php"</script>';
            
        }
    }
?> 
                </div>
            </div>
        </div>
    </main>
    <button class="login__btn2 btn__style1">로  그  인</button>
    
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
                                <img src="../../assets/img/Whatsapp.png" alt="Whatsapp">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>