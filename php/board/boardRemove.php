<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 삭제하기</title>
</head>
<body>
<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    $boardID = $_GET['boardID'];
    $memberID = $_SESSION['memberID'];

    //게시글 소유자 확인
    $sql = "SELECT memberID FROM board WHERE boardID = {$boardID}";
    $result = $connect ->query($sql);

    if($result) {
        $info = $result -> fetch_array(MYSQLI_ASSOC);
        // $info = $result->fetch_assoc();
        $boardOwnerID = $info['memberID'];

        // 로그인 ID 게시글 ID 일치하는지 확인
        if($memberID == $boardOwnerID) {
            $sql = "DELETE FROM board WHERE boardID = {$boardID}";
            $connect -> query($sql);
            echo "<script>alert('게시글이 삭제되었습니다.'); </script>";
        } else {
            echo "<script>alert('게시글 소유자만 삭제 할 수 있습니다.'); window.history.back()</script>";
        } 

    } else {
        echo "<script>alert('관리자에게 문의해주세요!'); window.history.back()</script>";
    }


    // $sql = "SELECT memberID FROM board WHERE boardID = {$boardID}";
    // $result = $connect->query($sql);

    // 로그인 한 사람만 지우기
    // if ($result->num_rows > 0) {
    //     $row = $result->fetch_assoc();
    //     $memberID = $row['memberID'];

    //     if ($loggedInUserID == $boardAuthorID) {
    //         $sql = "DELETE FROM board WHERE boardID = {$boardID}";
    //         $connect -> query($sql);
    //     } else
    //         echo "<script>alert('지울수 있는 권한이 없습니다. 로그인해주세요!'); window.history.back()</script>";
    // }
?>

    <script>
        location.href = "board.php";
    </script>
</body>
</html>