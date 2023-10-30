<?php
    include "../connect/connect.php";
    // include "../connect/session.php";

    if(isset($_GET['boardID'])){
        $boardID = $_GET['boardID'];
    } else {
        Header("Location: question.php");
    }

    // 조회수 추가
    $updateViewSql = "UPDATE teamBoard SET boardView = boardView + 1 WHERE boardID = '$boardID'";
    $connect -> query($updateViewSql);

    // 블로그 정보 가져오기
    $teamBoardSql = "SELECT * FROM teamBoard WHERE boardID = '$boardID'";
    $teamBoardResult = $connect->query($teamBoardSql);
    $teamBoardInfo = $teamBoardResult -> fetch_array(MYSQLI_ASSOC);

    // 이전글 가져오기
    $prevteamBoardSql = "SELECT * FROM teamBoard WHERE boardID < '$boardID' ORDER BY boardID DESC LIMIT 1";
    $prevteamBoardResult = $connect->query($prevteamBoardSql);
    $prevteamBoardInfo = $prevteamBoardResult -> fetch_array(MYSQLI_ASSOC);

    // 다음글 가져오기
    $nextteamBoardSql = "SELECT * FROM teamBoard WHERE boardID > '$boardID' ORDER BY boardID ASC LIMIT 1";
    $nextteamBoardResult = $connect->query($nextteamBoardSql);
    $nextteamBoardInfo = $nextteamBoardResult->fetch_array(MYSQLI_ASSOC);
    
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
    </style>
</head>

<body>
    <?php include "../include/header.php" ?>

    <!-- main -->
    <main id="main">
        <div class="board__title">
            <h1>Board</h1>
        </div>
        <section class="board__inner container">
            <div class="board__nav">
                <ul>
                    <li><a href="../board/notice.html">공지사항</a></li>
                    <li><a href="question.php" class="active">질문하기</a></li>
                    <li><a href="../board/question2.html">1:1문의</a></li>
                </ul>
            </div>
            
            <section class="board__view">
                <h3><i>제목: </i><?=$teamBoardInfo['boardTitle']?></h3>
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
                    <a href="boardView.php?boardID=<?=$prevteamBoardInfo['boardID']?>" class="prev">
                    이전글 <?=substr($prevteamBoardInfo['boardTitle'], 0, 20);?>...
                </a>
                <?php } else { ?>
                    <span class="prev">이전 글이 없습니다.</span>
                <?php } ?>

                <?php if(!empty($nextteamBoardInfo)) { ?>
                    <a href="boardView.php?boardID=<?=$nextteamBoardInfo['boardID']?>" class="next">
                    다음글 <?=substr($nextteamBoardInfo['boardTitle'], 0, 20);?>...
                </a>
                <?php } else { ?>
                    <span class="next">다음 글이 없습니다.</span>
                <?php } ?>
            </section>

            <div class="board__btns">
                <a href="question.php" class="write__btn">목록으로</a>
            </div>
        </section>
    </main>


    <!-- footer -->
    <?php include "../include/footer.php" ?>
    
</body>

</html>