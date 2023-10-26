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
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- 아이콘 -->
    <link rel="stylesheet" href="https://fontawesome.com/icons/bullhorn?f=classic&s=solid">

    <style>
        @media (max-width:1100px) {
            .board__nav ul {
                width: 50%;
            }
        }

        @media (max-width:660px) {
            .board__nav ul {
                width: 80%;
                height: 40px;
            }

            .board__nav li a {
                padding: 0;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <?php include "../include/header.php" ?>
    <!-- //header -->


    <!-- main -->
    <main id="main">
        <div class="board__title">
            <h1>Board</h1>
        </div>
        <section class="board__inner">
            <div class="board__nav">
                <ul>
                    <li><a href="../board/notice.html">공지사항</a></li>
                    <li><a href="../board/question.html">질문하기</a></li>
                    <li><a href="../board/question2.html">1:1문의</a></li>
                </ul>
            </div>

            <div class="board__write container">
                <form action="boardWriteSave.php" name="boardWriteSave" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="boardCategory" class="blind">카테고리</label>
                        <select name="boardCategory" id="boardCategory">
                            <option value="질문게시판">질문 게시판</option>
                            <option value="문의게시판">문의 게시판</option>
                        </select>
                    </div>
                    <table class="write__table">
                        <tr>
                            <td>제목</td>
                            <td><input type="text" id="boardTitle" name="boardTitle"></td>
                        </tr>
                        <tr>
                            <td>내용</td>
                            <td><textarea name="boardContents" id="boardContents" rows="20"></textarea></td>
                        </tr>
                    </table>
                    <div class="file">
                        <!-- accept=".jpg, .jpeg, .png, .gif, .webp" -->
                        <label for="boardFile" class="blind">파일</label>
                        <input type="file" id="boardFile" name="boardFile">
                        <p>* jpg, gif, png, webp 파일만 넣을 수 있습니다. 이미지 용량은 1MB를 넘길 수 없습니다.</p>
                    </div>
                    <div class="board__btns">
                        <a href="question.php" class="write__btn2">취소</a>
                        <button type="submit" class="write__btn">저장하기</button>
                    </div>
                </form>
            </div>
        </section>
    </main>


    <!-- footer -->
    <?php include "../include/footer.php" ?>
</body>

</html>