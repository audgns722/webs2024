<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset($_SESSION['memberId'])){
        $memberId = $_SESSION['memberId'];   
    } else {
        $memberId = 0;
    }

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    if(isset($_GET['boardId'])){
        $boardId = $_GET['boardId'];
    } else {
        Header("Location: board.php");
    }

    // 조회수 추가
    $updateViewSql = "UPDATE teamBoard SET boardView = boardView + 1 WHERE boardId = '$boardId'";
    $connect -> query($updateViewSql);

    // 블로그 정보 가져오기
    $teamBoardSql = "SELECT * FROM teamBoard WHERE boardId = '$boardId'";
    $teamBoardResult = $connect->query($teamBoardSql);
    $teamBoardInfo = $teamBoardResult -> fetch_array(MYSQLI_ASSOC);

    // 이전글 가져오기
    $prevteamBoardSql = "SELECT * FROM teamBoard WHERE boardId < '$boardId' ORDER BY boardId DESC LIMIT 1";
    $prevteamBoardResult = $connect->query($prevteamBoardSql);
    $prevteamBoardInfo = $prevteamBoardResult -> fetch_array(MYSQLI_ASSOC);

    // 다음글 가져오기
    $nextteamBoardSql = "SELECT * FROM teamBoard WHERE boardId > '$boardId' ORDER BY boardId ASC LIMIT 1";
    $nextteamBoardResult = $connect->query($nextteamBoardSql);
    $nextteamBoardInfo = $nextteamBoardResult->fetch_array(MYSQLI_ASSOC);
     // 댓글 정보 가져오기
    $commentSql = "SELECT * FROM boardComment WHERE boardId = '$boardId' AND commentDelete = '1' ORDER BY commentId ASC";
    $commentResult = $connect -> query($commentSql);
    $commentInfo = $commentResult -> fetch_array(MYSQLI_ASSOC);   
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        .board__nav {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 100px;
        }

        .board__nav ul {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F5F5F2;
            border-radius: 50px;
            width: 30%;
            height: 50px;
        }
        .board__search .right {
            position: relative;
        }

        .board__nav li a {
            font-size: 0.8rem;
            margin: 0 25px 0 25px;
        }

        .board__nav:active {
            text-decoration: underline;
        }

        .board__table td {
            padding: 25px 5px;
            border-bottom: 1px solid #b3b3b3;
            text-align: center;
        }

        .board__search .left {
            margin-left: 30px;
            font-size: 0.8rem;
        }

        .btn__style2 {
            width: 100px;
            height: 39px;
            background-color: #285A5B;
            font-size: 0.9rem;
            color: #fff;
            border-radius: 50px;
            cursor: pointer;
        }
        .board__view {
        }
        .board__view h3 {
            padding: 5px 30px;
            border-bottom: 1px solid #999999;
        }
        .board__view i {
            font-style: normal;
        }
        .board__view .info {
            padding: 5px 30px;
            border-bottom: 1px solid #999999;
        }
        .board__view .contents {
            display: inline-block;
        }
        .blog__index {
            border-top: 1px solid var(--black500);
            border-bottom: 1px solid var(--black500);
            padding: 5px 30px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .board__view .contents {
            padding: 5px 30px;
            display: flex;
            justify-content: space-between;
        }
        .board__view .contents span {
            height: 300x;
            width: 50%;

        }
        .board__view .contents img {
            width: 300px;
            height: 300px;
            border: 1px solid #000;
        }
        .write__btn {
            text-align: center;
        }
        .board__title {
            margin-top: 0;
        }
        @media(max-width:1100px){
            .board__nav ul {
                width: 45%;
            }
            .board__search .left {
                display: none;
            }
            .board__search {
                justify-content: flex-end;
            }
        }
        @media(max-width:800px){
            
            
            .board__title {
                margin-top: 15px;
            }
            .board__inner {
                padding: 40px 0;
            }
        }
        @media(max-width:660px){
            .board__nav ul {
                width: 70%;
            }
            .board__search .right select {
                width: 100px;
                display: flex;
            }
            .btn__write {
                position: absolute;
                top: -5px;
                right: 0;
            }
        }
        .blog__comment {
            padding: 100px 0;
        }

        .blog__comment h4 {
            width: 100%;
            border-top: 2px solid var(--black);
            border-bottom: 1px dashed var(--black);
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }

        .comment__view {
            position: relative;
            margin-bottom: 20px;
        }

        .comment__view .avata {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-image: url(../../assets/face/Suspicious.svg);
            background-size: cover;
            border: 2px solid var(--black);
            position: absolute;
            left: 0;
            top: 0;
        }

        .comment__view:nth-child(even) .avata {
            left: auto;
            right: 0;
            transform: rotateY(180deg);
        }

        .comment__view:nth-child(even) .texts {
            text-align: right;
        }

        .comment__view:nth-child(even) .texts p {
            border-radius: 10px 0 10px 10px;
            text-align-last: left;
        }

        .comment__view:nth-child(2) .avata {
            background-image: url(../../assets/face/Cheeky.svg);
        }

        .comment__view:nth-child(3) .avata {
            background-image: url(../../assets/face/Awe.svg);
        }

        .comment__view:nth-child(4) .avata {
            background-image: url(../../assets/face/Concerned.svg);
        }

        .comment__view:nth-child(5) .avata {
            background-image: url(../../assets/face/Rage.svg);
        }

        .comment__view .texts {
            margin-left: 60px;
            margin-right: 60px;
        }

        .comment__view .texts>span {
            display: block;
            font-size: 14px;
            color: var(--black300);
        }

        .comment__view .texts p {
            background-color: #F5F5F2;
            padding: 10px;
            border-radius: 0 10px 10px 10px;
            display: inline-block;
            margin-top: 4px;
        }

        .comment__view .texts .modify {
            text-decoration: underline;
            text-underline-position: under;
        }

        .comment__view .texts .modify:hover {
            color: var(--black)
        }

        .comment__view .texts .delete {
            text-decoration: underline;
            text-underline-position: under;
        }

        .comment__view .texts .delete:hover {
            color: var(--black)
        }

        .comment__input {
            margin-top: 50px;
            padding-top: 50px;
            border-top: 1px dashed var(--black);
        }

        .comment__input fieldset {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .comment__input #commentName {
            width: 49.5%;
        }

        .comment__input #commentPass {
            width: 49.5%;
        }

        .comment__input #commentWrite {
            width: 100%;
            margin-top: 10px;
        }

        #popupDelete {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10000;
        }

        .comment__delete {
            width: 400px;
            height: 400px;
            background-color: #F5F5F2;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 40px;
            border: 2px solid var(--black);
        }

        .comment__delete h4 {
            margin-bottom: 10px;
        }

        .comment__delete input {
            border: 1px solid var(--black400);
            padding: 1rem;
            width: 100%;
            font-size: 1rem;
        }

        .comment__delete p {
            margin-top: 10px;
            color: var(--black300);
        }

        .comment__delete .btn {
            position: absolute;
            right: 20px;
            bottom: 20px;
        }

        .comment__delete .btn button {
            background-color: #285A5B;
            color: var(--white);
            padding: 5px 20px;
            cursor: pointer;
            border-radius: 5px;
        }


        #popupModify {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10000;
        }

        .comment__modify {
            width: 400px;
            height: 400px;
            background-color: #F5F5F2;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 40px;
            border: 2px solid var(--black);
        }

        .comment__modify h4 {
            margin-bottom: 10px;
        }

        .comment__modify textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 1rem;
            resize: none;
        }

        .comment__modify input {
            border: 1px solid var(--black400);
            padding: 1rem;
            width: 100%;
            font-size: 1rem;
        }

        .comment__modify p {
            margin-top: 10px;
            color: var(--black300);
        }

        .comment__modify .btn {
            position: absolute;
            right: 20px;
            bottom: 20px;
        }

        .comment__modify .btn button {
            background-color: #285A5B;
            color: var(--white);
            padding: 5px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .none {
            display: none;
        }
        .input__style {
            width: 100%;
            background-color: #F5F5F2;
            border-radius: 5px;
            padding: 1rem 1.4rem;
            font-weight: 300;
            border: 0;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <?php include "../include/header.php" ?>

    <!-- main -->
    <main id="main">
        <div class="board__title">
            <h1><?=$category?></h1>
        </div>
        <section class="board__inner container">
            <div class="board__nav">
                <ul>
                    <li><a href="boardCate.php?category=공지사항">공지사항</a></li>
                    <li><a href="boardCate.php?category=질문하기">질문하기</a></li>
                    <li><a href="boardCate.php?category=문의하기">문의하기</a></li>
                </ul>
            </div>
            <section class="board__view">
                <h3><i>제목: </i><?=$teamBoardInfo['boardTitle']?></h3>
                <label for="boardCategory" class="blind">카테고리:</label>
                <select name="boardCategory" id="boardCategory">
                    <option value="질문하기">질문하기</option>
                    <option value="1:1문의">1:1문의</option>
                </select>
                <div class="info">
                    <span class="author"><i>작성자: </i><?=$teamBoardInfo['boardAuthor']?></span>
                    <span class="date"><i>작성일자: </i><?=date('Y-m-d', $teamBoardInfo['regTime'])?></span>
                </div>
                <div class="contents">
                    <span><?=$teamBoardInfo['boardContents']?></span>
                    <img src="../../assets/board/<?=$teamBoardInfo['boardImgFile']?>" alt="<?=$teamBoardInfo['boardTitle']?>">
                </div>
            </section>

            <section class="blog__index">
                <h4 class="blind">이전글/다음글 가기</h4>

<?php if(!empty($prevteamBoardInfo)) { ?>
    <a href="boardView.php?boardId=<?=$prevteamBoardInfo['boardId']?>" class="prev">
    이전글 <?=substr($prevteamBoardInfo['boardTitle'], 0, 20);?>...
</a>
<?php } else { ?>
    <span class="prev">이전 글이 없습니다.</span>
<?php } ?>

<?php if(!empty($nextteamBoardInfo)) { ?>
    <a href="boardView.php?boardId=<?=$nextteamBoardInfo['boardId']?>" class="next">
    다음글 <?=substr($nextteamBoardInfo['boardTitle'], 0, 20);?>...
</a>
<?php } else { ?>
    <span class="next">다음 글이 없습니다.</span>
<?php } ?>
            </section>

            <section id="blogComment" class="blog__comment">
                    <h4>댓글 쓰기</h4>
                    <div class="comment">

<?php
    if($commentResult->num_rows == 0){?>
        <div class="comment__view">
            <div class="avata"></div>
            <div class="texts">
                <span>아무런 흔적이 없어!!</span>
                <p>댓글작성해라</p>
            </div>
        </div>
    <?php } else { 
        foreach($commentResult as $comment){ ?>
            <div class="comment__view">
                <div class="avata"></div>
                <div class="texts">
                    <span>
                        <span class="author"><?=$comment['commentName']?></span>
                        <span class="date"><?=date('Y-m-d H:i', $comment['regTime'])?></span>
                        <a href="#" class="modify" data-comment-id="<?=$comment['commentId']?>">수정</a>
                        <a href="#" class="delete" data-comment-id="<?=$comment['commentId']?>">삭제</a>
                    </span>
                    <p><?=$comment['commentMsg']?></p>
                </div>
            </div>
    <?php }
    }
?>
                    <div class="comment__input">
                        <form action="#">
                            <fieldset>
                                <legend class="blind">댓글쓰기</legend>
                                <label for="commentName" class="blind">이름</label>
                                <input type="text" id="commentName" name="commentName" class="input__style" placeholder="이름" required>
                                <label for="commentPass" class="blind">비밀번호</label>
                                <input type="password" id="commentPass" name="commentPass" class="input__style" placeholder="비밀번호" required>
                                <label for="commentWrite" class="blind">댓글쓰기</label>
                                <input type="text" id="commentWrite" name="commentWrite" class="input__style" placeholder="댓글을 써주세요!" required>
                                <button type="button" id="commentWriteBtn" class="btn__style2 mt10">댓글 쓰기</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </section>

            <div class="board__btns">
                <a href="board.php" class="write__btn">목록으로</a>
            </div>
        </section>
    </main>


    <!-- footer -->
    <?php include "../include/footer.php" ?>
    <div id="popupDelete" class="none">
        <div class="comment__delete">
            <h4>댓글 삭제</h4>
            <label for="commentDeletePass" class="blind">비밀번호</label>
            <input type="password" id="commentDeletePass" name="commentDeletePass" placeholder="비밀번호">
            <p>* 입력했던 비밀번호를 입력해주세요!</p>
            <div class="btn">
                <button id="commentDeleteCancel">취소</button>
                <button id="commentDeleteButton">삭제</button>
            </div>
        </div>
    </div>

    <div id="popupModify" class="none">
        <div class="comment__modify">
            <h4>댓글 삭제</h4>
            <label for="commentModifyMsg" class="blind">비밀번호</label>
            <textarea name="commentModifyMsg" id="commentModifyMsg" rows="4" placeholder="수정할 내용을 적어주세요!"></textarea>
            <input type="password" id="commentModifyPass" name="commentModifyPass" placeholder="비밀번호">
            <p>* 입력했던 비밀번호를 입력해주세요!</p>
            <div class="btn">
                <button id="commentModifyCancel">취소</button>
                <button id="commentModifyButton">수정</button>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
    // 페이지가 로드될 때 실행되는 JavaScript
    window.addEventListener('DOMContentLoaded', (event) => {
        // h1 태그에 옵션의 값을 설정
        document.querySelector('h1').textContent = document.querySelector('#boardCategory').value;
    });

    // select 요소의 값이 변경될 때 실행되는 JavaScript
    document.querySelector('#boardCategory').addEventListener('change', function() {
        // h1 태그에 옵션의 값을 설정
        document.querySelector('h1').textContent = this.value;
    });
</script>
    <script>
        
        let commentId = "";
        // 댓글 쓰기 버튼
        $("#commentWriteBtn").click(function () {
            if ($("#commentWrite").val() == "") {
                alert("댓글을 작성하세요.");
                $("#commentWrite").focus();
            } else {
                // memberId가 1 이상인 경우에만 댓글 작성을 수행
                if (<?=$memberId?> >= 1) {
                    $.ajax({
                        url: "boardCommentWrite.php",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "boardId": <?=$boardId?>,
                            "memberId": <?=$memberId?>,
                            "name": $("#commentName").val(),
                            "pass": $("#commentPass").val(),
                            "msg": $("#commentWrite").val(),
                        },
                        success: function (data) {
                            console.log(data);
                            location.reload();
                        },
                        error: function (request, status, error) {
                            console.log("request" + request);
                            console.log("status" + status);
                            console.log("error" + error);
                        }
                    });
                } else {
                    // memberId가 1 미만인 경우
                    alert("로그인이 필요합니다.");
                    window.location.href = "../login/login.php";
                }
            }
        });



        // 댓글 삭제 버튼
        $(".comment__view .delete").click(function(e){
            e.preventDefault();
            $("#popupDelete").removeClass("none");
            commentId = $(this).data("comment-id");
        });

        // 댓글 삭제 버튼 ---> 취소 버튼
        $("#commentDeleteCancel").click(function(){
            $("#popupDelete").addClass("none");
        });

        // 댓글 삭제 버튼 ---> 삭제 버튼
        $("#commentDeleteButton").click(function(){
            if($("#commentDeletePass").val() == ""){
                alert("댓글 작성시 비밀번호를 작성해주세요!");
                $("#commentDeletePass").focus();
            } else {
                $.ajax({
                    url: "boardCommentDelete.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentPass": $("#commentDeletePass").val(),
                        "commentId": commentId,
                    },
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 삭제되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });

        // 댓글 수정 버튼
        $(".comment__view .modify").click(function(e){
            e.preventDefault();
            $("#popupModify").removeClass("none");
            commentId = $(this).data("comment-id");

            let commentMsg = $(this).closest(".comment__view").find("p").text();
            $("#commentModifyMsg").val(commentMsg);
        });;

        // 댓글 수정 버튼 ---> 취소 버튼
        $("#commentModifyCancel").click(function(){
            $("#popupModify").addClass("none");
        });

        // 댓글 삭제 버튼 ---> 수정 버튼
        $("#commentModifyButton").click(function(){
            if($("#commentModifyPass").val() == ""){
                alert("댓글 수정시 비밀번호를 작성해주세요!");
                $("#commentModifyPass").focus();
            } else {
                $.ajax({
                    url: "boardCommentModify.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "commentMsg": $("#commentModifyMsg").val(),
                        "commentPass": $("#commentModifyPass").val(),
                        "commentId": commentId,
                    },
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("댓글이 수정되었습니다.");
                        }
                        location.reload();
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });
    </script>
    
</body>

</html>