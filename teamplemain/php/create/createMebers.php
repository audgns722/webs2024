<?php
    include "../connect/connect.php";

    $sql = "create table teamMembers(";
    $sql .= "teamMemberID int(10) unsigned auto_increment,";
    $sql .= "youId varchar(10) NOT NULL,";
    $sql .= "youPass varchar(40) NOT NULL,";
    $sql .= "youName varchar(20) NOT NULL,";
    $sql .= "youPhone varchar(40) DEFAULT NULL,";
    $sql .= "youBrith varchar(20) DEFAULT NULL,";
    $sql .= "regTime int(20) NOT NULL,";
    $sql .= "PRIMARY KEY(teamMemberID)";
    $sql .= ") charset=utf8";
    
    $result = $connect -> query($sql);

    if($result){
        echo "Create Tables Complete";
    } else {
        echo "Create Tables False";
    }
?>