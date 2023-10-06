<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $boardID = $_GET['boardID'];
    $boardTitle = $_POST['boardTitle'];
    $boardContents = $_POST['boardContents'];
    $memberID = $_SESSION['memberID'];

    if(empty($boardTitle) || empty($boardContents)) {
        echo "<script>alert('제목과 내용을 모두 입력해야 합니다.'); window.history.back()</script>";
    } else {
        $boardTitle = $connect -> real_escape_string($boardTitle);
        $boardContents = $connect -> real_escape_string($boardContents);

        // 게시물 수정 로직
        $sql = "UPDATE board SET boardTitle = '$boardTitle', boardContents = '$boardContents' WHERE boardID = $boardID";
       
        if ($connect->query($sql)) {
            $connect->commit(); // 커밋 추가
            echo "<script>alert('글이 성공적으로 수정되었습니다.'); window.location.href = 'board.php';</script>";
        } else {
            echo "<script>alert('글 수정에 실패했습니다. MySQL 오류: " . $connect->error . "');</script>";
        }
    }

    // $sql = "";
    // $connect -> query($sql);
?>