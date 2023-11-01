<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // if(isset($_GET['category'])){
    //     $category = $_GET['category'];

    // } else {
    //     Header("Location: board.php");
    // }

    // $categorySql = "SELECT * FROM teamBoard WHERE boardDelete = 1 AND boardCategory = '$category' ORDER BY boardId DESC";
    // $categoryResult = $connect -> query($categorySql);
    // $categoryInfo = $categoryResult -> fetch_array(MYSQLI_ASSOC);
    // $categoryCount = $categoryResult -> num_rows;

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
    $boardSql = "SELECT * FROM teamBoard WHERE boardDelete = 1 ORDER BY boardId DESC LIMIT $viewLimit, $viewNum";
    $boardInfo = $connect->query($boardSql);

    $sql = "SELECT count(boardId) FROM teamBoard";
    $result = $connect->query($sql);

    $boardTotalCount = $result->fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardId)'];


?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../assets/css/style.css">

    <?php include "../include/boardcss.php" ?>
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
                    <li><a href="boardCate.php?category=공지사항">공지사항</a></li>
                    <li><a href="boardCate.php?category=질문하기">질문하기</a></li>
                    <li><a href="boardCate.php?category=문의하기">문의하기</a></li>
                </ul>
            </div>
            <div class="board__search">
                <div class="left">
                    <p>* 분리배출에 관련된 내용을 질문하는 게시판 입니다.</p>
                    <label for="boardCategory" class="blind">카테고리:</label>
                </div>
                
                <div class="right">
                    <form action="boardSearch.php" name="boardSearch" method="get">
                        <fieldset>
                            <legend class="blind">게시판 검색 영역</legend>
                            <div class="search__btn">
                                <button type="submit" class="btn__style2">검 색</button>
                                <a href="write.php" class="btn__write btn__style2">글쓰기</a>
                            </div>
                            <select name="searchOption" id="searchOption">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!">
                            
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 10%;">
                        <col class="table__col2">
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
                        
<?php foreach($boardInfo as $board){ ?>
    <tr>
        <td><?=$board['boardId']?></td>
        <td><a href='boardView.php?boardId=<?=$board['boardId']?>'><?=$board['boardTitle']?></a></td>
        <td><?=$board['boardAuthor']?></td>
        <td><?=date('Y-m-d', $board['regTime'])?></td>
        <td><?=$board['boardView']?></td>
    </tr>
<?php } ?>

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
        echo "<li class='first'><a href='board.php?page=1'>❰❰</a></li>";
        echo "<li class='prev'><a href='board.php?page=" . ($page - 1) . "'>❰</a></li>";
    }

    // 페이지
    for ($i = 1; $i <= $boardTotalCount; $i++) {
        $active = "";
        if ($i == $page) $active = "active";

        echo "<li class='{$active}'><a href='board.php?page={$i}'>${i}</a></li>";
    }

    // 다음 페이지, 마지막으로 가기
    if ($page < $boardTotalCount) {
        echo "<li class='next'><a href='board.php?page=" . ($page + 1) . "'>❱</a></li>";
        echo "<li class='last'><a href='board.php?page={$boardTotalCount}'>❱❱</a></li>";
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