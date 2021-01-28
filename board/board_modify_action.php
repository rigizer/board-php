<?php include  $_SERVER['DOCUMENT_ROOT']."/board/db_conn.php"; ?>
<?php
    // parameter
    // board_no, board_title, board_content, board_user

    $board_no = $_POST["board_no"];
    $board_title = $_POST["board_title"];
    $board_content = $_POST["board_content"];
    $board_user = $_POST["board_user"];

    $result = mysqli_query($conn, "UPDATE board SET board_title = '$board_title', board_content = '$board_content', board_user = '$board_user', board_date = NOW() WHERE board_no = '$board_no'");

    mysqli_close($conn);

    header("Location: /board/board_view.php?board_no=".$board_no);
?>