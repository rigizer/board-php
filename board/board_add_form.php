<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>board_add</title>
		
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
		</style>
	</head>
	<body>
        <?php include  $_SERVER['DOCUMENT_ROOT']."/board/board_menu.php"; ?>
		<div class="container center">
			<br>
		
			<h1>게시물 작성</h1>
			
			<br>

            <form method="post" action="./board_add_action.php">
                <div class="btn-group" style="float: right;">
                    <button type="button" class="btn btn-sm btn-dark" onclick="location.href='./board_list.php'">목록</button>
                    <button type="submit" class="btn btn-sm btn-success">작성</button>
                </div>

				<br><br>

                <table class="table center">
                    <tr>
						<th>작성자</th>
                        <td>
                            <input type="text" class="form-control" name="board_user"></input>
                        </td>
                    </tr>
                    <tr>
						<th>비밀번호</th>
                        <td>
                            <input type="password" class="form-control" name="board_pw"></input>
                        </td>
					</tr>
					<tr>
						<th>제목</th>
                        <td>
                            <input type="text" class="form-control" name="board_title"></input>
                        </td>
                    </tr>
                    <tr>
						<th>내용</th>
                        <td>
                            <textarea class="form-control" name="board_content" rows="20"></textarea>
                        </td>
                    </tr>
                </table>
            </form>
            
			<br><br>
        </div>
	</body>
</html>