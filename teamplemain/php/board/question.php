<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // 한 페이지에 보여질 항목 수
    $viewNum = 10;

    // 현재 페이지 번호를 가져옴
    if(isset($_GET['page'])){
        $page = (int) $_GET['page'];
    } else {
        $page = 1;
    }

    // 시작 레코드 인덱스 계산
    $viewLimit = ($viewNum * $page) - $viewNum;

    // SQL 쿼리
    $boardSql = "SELECT * FROM teamBoard WHERE boardDelete = 1 ORDER BY boardID DESC LIMIT $viewLimit, $viewNum";
    $boardInfo = $connect->query($boardSql);

    $sql = "SELECT count(boardID) FROM teamBoard";
    $result = $connect->query($sql);

    $boardTotalCount = $result->fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardID)'];
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../assets/css/style.css">

    <?php include "../include/questioncss.php" ?>
</head>

<body>
    <?php include "../include/header.php" ?>

    <!-- main -->
    <main id="main">
        <div class="board__title container">
            <h1>Board</h1>
        </div>
        <section class="board__inner container">
            <div class="board__nav">
                <ul>
                    <li><a href="#">공지사항</a></li>
                    <li><a href="question.php" class="active">질문하기</a></li>
                    <li><a href="#">1:1문의</a></li>
                </ul>
            </div>
            <div class="board__search">
                <div class="left">
                    * 분리배출에 관련된 내용을 질문하는 게시판 입니다.
                </div>
                <div class="right">
                    <form action="boardSearch.php" name="boardSearch" method="get">
                        <fieldset>
                            <legend class="blind">게시판 검색 영역</legend>
                            <select name="searchOption" id="searchOption">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!">
                            <button type="submit" class="btn__style2">검 색</button>
                            <a href="write.php" class="btn__write btn__style2">글쓰기</a>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 10%;">
                        <col>
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 10%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>등록자</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    while ($row = $boardInfo->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['boardID']}</td>";
        echo "<td><a href='boardView.php?boardID={$row['boardID']}'>{$row['boardTitle']}</a></td>";
        echo "<td>{$row['boardAuthor']}</td>";
        echo "<td>" . date('Y-m-d', $row['regTime']) . "</td>";
        echo "<td>{$row['boardView']}</td>";
        echo "</tr>";
    }
?>
                    </tbody>
                </table>
            </div>

            <div class="board__pages">
                <ul>
<?php
    // 총 페이지 갯수
    $boardTotalCount = ceil($boardTotalCount / $viewNum);

    // 이전 페이지, 처음으로 가기
    if ($page > 1) {
        echo "<li class='first'><a href='question.php?page=1'>처음으로</a></li>";
        echo "<li class='prev'><a href='question.php?page=" . ($page - 1) . "'>이전</a></li>";
    }

    // 페이지
    for ($i = 1; $i <= $boardTotalCount; $i++) {
        $active = "";
        if ($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='question.php?page={$i}'>${i}</a></li>";
    }

    // 다음 페이지, 마지막으로 가기
    if ($page < $boardTotalCount) {
        echo "<li class='next'><a href='question.php?page=" . ($page + 1) . "'>다음</a></li>";
        echo "<li class='last'><a href='question.php?page={$boardTotalCount}'>마지막으로</a></li>";
    }
?>
                </ul>
            </div>
        </section>
    </main>


    <!-- footer -->
    <?php include "../include/footer.php" ?>
    
</body>

</html>