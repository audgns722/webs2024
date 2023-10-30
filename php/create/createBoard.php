<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE board(";
    $sql .= "boardID int(10) unsigned NOT NULL auto_increment,";
    $sql .= "memberID int(10) NOT NULL,";
    $sql .= "boardTitle varchar(100) NOT NULL,";
    $sql .= "boardContents longtext NOT NULL,";
    $sql .= "blogCategory varchar(10) NOT NULL,";
    $sql .= "blogAuthor varchar(10) NOT NULL,";
    $sql .= "boardView int(10) NOT NULL,";
    $sql .= "regTime int(40) NOT NULL,";
    $sql .= "blogImgFile varchar(100) DEFAULT NULL,";
    $sql .= "blogImgSize varchar(100) DEFAULT NULL,";
    $sql .= "blogModTime int(10) DEFAULT NULL,";
    $sql .= "blogDelete int(10) DEFAULT 1,";
    $sql .= "PRIMARY KEY(boardID)";
    $sql .= ") charset=utf8";

    $connect -> query($sql);
?>