<?php include  $_SERVER['DOCUMENT_ROOT']."/board/db_conn.php"; ?>
<?php
    // parameter
    // board_no

    if(isset($_GET["board_no"])) {
        $board_no = (int)($_GET["board_no"]);
    }

    $result = mysqli_query($conn, "DELETE FROM board WHERE board_no = '$board_no'");

    mysqli_close($conn);

    header("Location: /board/board_list.php");
?>