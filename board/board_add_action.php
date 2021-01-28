<?php include  $_SERVER['DOCUMENT_ROOT']."/board/db_conn.php"; ?>
<?php
    // parameter
    // board_pw, board_title, board_content, board_user

    $board_pw = $_POST["board_pw"];
    $board_title = $_POST["board_title"];
    $board_content = $_POST["board_content"];
    $board_user = $_POST["board_user"];

    $result = mysqli_query($conn, "INSERT INTO board(board_pw, board_title, board_content, board_user, board_date) VALUES('$board_pw', '$board_title', '$board_content', '$board_user', NOW())");

    mysqli_close($conn);

    header("Location: /board/board_list.php");
?>