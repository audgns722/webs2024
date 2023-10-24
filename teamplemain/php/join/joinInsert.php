<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    
<style>

    .login__box form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-top: 2rem;
    }
    .CheckMsg {
        width: 353px;
        margin-top: 5px;
        display: flex;
        white-space: wrap;
        justify-content: space-between;
    }
    .msg {
        /* width: 50%; */
        color : red;
        font-weight: 500;
        font-size: 0.8rem;
        margin-top: 5px;
    }
    .join label {
        width: 353px;
        display: flex;
        flex-wrap : wrap;
        justify-content: space-between;
        align-items: center;
    }
    #youId {
        /* width: 250px; */
        margin-top: 0;
    }
    #youId {
        width: 72%;
    }
    .btn {
        width: 25%;
        background-color: var(--mycolor1);
        color : var(--white);
        text-align: center;
        padding: 5px;
        cursor: pointer;
        display: inline-block;
        font-size: 0.8rem;
        border-radius: 5px;
    }
    @media (max-width : 650px) {
        .login__box {
            height: 530px;
        }
    }
</style>
</head>
<body>
    <?php include "../include/header.php" ?>

    <main id="main">
        <div class="login__inner container">
            <div class="login__wrap">
                <div class="images__wrap">
                    <span></span>
                    <h1>지구를 생각하는<br>
                        작은 실천들</h1>
                </div>
            <div class="join__insert">
                <div class="login__box">
                    <h2>가입하기</h2>
                    <h3>이미 계정이 있습니까?<a href="login.html" class="joinbtn">로그인</a></h3>
                    <form action="joinResult.php" name="joinResult" method="post" onsubmit="return joinChecks();">
                    <div class="join">
                        <label for="youId">
                            <input type="text" id="youId" name="youId" placeholder="아이디를 입력해주세요">
                            <div class="btn" onclick="idChecking()">중복 검사</div>
                            <p class="msg" id="youIdComment"></p>
                        </label>
                    </div>
                        <label for="youPass">
                            <input type="password" placeholder="비밀번호">
                        </label>
                        <label for="youName">
                            <input type="text" placeholder="이름">
                        </label>
                        <label for="youPhone">
                            <input type="password" placeholder="휴대폰">
                        </label>
                        <label for="youBrith">
                            <input type="text" placeholder="생년월일">
                        </label>
                        <button class="login__btn2 btn__style1" href="#">회 원 가 입</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
    <?php include "../include/footer.php" ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        let isIdCheck = false;

        function idChecking(){
            let youId = $("#youId").val();

            if(youId == null || youId ==''){
                $("#youIdComment").text("**아이디를 입력해주세요!");
            } else {
                // 아이디 유효성 검사
                let getYouId = RegExp(/^[a-zA-Z0-9_-]{4,20}$/);

                if(!getYouId.test($("#youId").val())){
                    $("#youIdComment").text("아이디는 영어와 숫자를 포함하여 4~20글자 이내로 작성성이 가능합니다.");
                    $("#youId").val('');
                    $("#youId").focus();
                    
                    return false;
                } else {
                    $("#youIdComment").text("사용 가능한 아이디입니다.");
                }
                $.ajax({
                    type : "POST",
                    url : "joinCheck.php",
                    data : {"youId" : youId, "type" : "isIdCheck"},
                    dataType : "json",
                    success : function (data){
                        if(data.result == "good"){
                            $("#youIdComment").text("사용 가능한 아이디 입니다.");
                            isIdCheck = true;
                        } else {
                            $("#youIdComment").text("이미 존재하는 아이디 입니다.");
                            isIdCheck = false;
                        }
                    }
                })
            } 

        }
        
        function joinChecks(){

        // ID유효성 검사
        if( $("#youId").val() == '' ){
            $("#youIdComment").text("-> 아이디를 작성해주세요!");
            $("#youId").focus();
            return false;
        }
        }
    </script>
</body>
</html>