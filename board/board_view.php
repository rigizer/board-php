<?php include  $_SERVER['DOCUMENT_ROOT']."/board/db_conn.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>board_view</title>
		
		<!-- Bootstrap Framework 사용 -->
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		
		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
		<!-- Bootstrap 4 Icons -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		
		<!-- Google Web Fonts -->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Do+Hyeon&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
		
		<style>
			.center {
				margin: auto;
				text-align: center;
            }
			
			.ul-center {
				margin-left: auto;
 				margin-right: auto;
			}
			
			.title {
				font-family: 'Righteous', cursive;
			}
			
			body {
				font-family: 'Noto Sans KR', sans-serif;
			}
			
			h1 {
				font-family: 'Do Hyeon', sans-serif;
			}
			
			th {
				background-color: #F9F9FB;
			}

            td {
                text-align: left;
            }
		</style>
	</head>
	<body>
        <?php
            // primary_key인 board_no를 토대로 작성자, 제목, 내용 데이터를 불러온다
            if(isset($_GET["board_no"])) {
                $board_no = (int)($_GET["board_no"]);
            }

            // 게시물 데이터
            $sql_query = "SELECT board_title, board_content, board_pw, board_user, board_date FROM board WHERE board_no = $board_no";
            $result = mysqli_query($conn, $sql_query);
            $row = mysqli_fetch_array($result);
        ?>
        <?php include  $_SERVER['DOCUMENT_ROOT']."/board/board_menu.php"; ?>
		<div class="container center">
			<br>
		
			<h1>게시물 내용</h1>
			
			<br>
            
            <div class="btn-group" style="float: right;">
                <button type="button" class="btn btn-sm btn-dark" onclick="location.href='./board_list.php'">목록</button>
                <button type="button" class="btn btn-sm btn-primary" onclick="location.href='./board_modify_form.php?board_no=<?php echo $board_no ?>'">수정</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="location.href='./board_remove.php?board_no=<?php echo $board_no ?>'">삭제</button>
            </div>

            <br><br>

            <table class="table center">
                <tr>
                    <th width="15%">번호</th>
                    <td width="85%"><?php echo $board_no ?></td>
                </tr>
                <tr>
                    <th>작성자</th>
                    <td><?php echo $row['board_user'] ?></td>
                </tr>
                <tr>
                    <th>작성일</th>
                    <td><?php echo $row['board_date'] ?></td>
                </tr>
                <tr>
                    <th>제목</th>
                    <td><?php echo $row['board_title'] ?></td>
                </tr>
                <tr>
                    <th>내용</th>
                    <td><?php echo $row['board_content'] ?></td>
                </tr>
            </table>
            
			<br><br>
        </div>
	</body>
</html>