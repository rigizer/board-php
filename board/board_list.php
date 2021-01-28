<?php include  $_SERVER['DOCUMENT_ROOT']."/board/db_conn.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>board_list</title>
		
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

			.msg-title {
				white-space: nowrap;
				overflow: hidden;
				text-overflow: ellipsis;
			}

			.msg-writer {
				white-space: nowrap;
				overflow: hidden;
				text-overflow: ellipsis;
			}

			.tb-fixed {
				table-layout: fixed;
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

			a:link {color: black;}
			a:visited {color: black;}
			a:active {color: black;}
			a:hover {color: black;}
		</style>
	</head>
	<body>
        <?php
            // 기본적으로 1 페이지 출력
            $current_page = 1;

            // 만약 request로 current_page를 받는다면 그 값으로 수정
            if(isset($_GET["current_page"])) {
                $current_page = (int)($_GET["current_page"]);
            }

            // 한 페이지당 데이터를 표시할 개수
            $row_per_page = 10;

            // 시작 데이터 계산
            $begin_row = ($current_page - 1) * $row_per_page;

            // 전체 데이터 수
            $sql_query_count = "SELECT COUNT(*) as cnt FROM board";
            $count_result = mysqli_query($conn, $sql_query_count);

            $count_row = mysqli_fetch_array($count_result);
            $total_count = $count_row["cnt"];

            // 목록 데이터
            $sql_query_list = "SELECT board_no, board_title, board_user, board_date FROM board ORDER BY board_no DESC LIMIT $begin_row, $row_per_page";
            $list_result = mysqli_query($conn, $sql_query_list);
            
            // 마지막 페이지
            $last_page = (int)($total_count / $row_per_page);
            
            // 10 미만의 개수의 데이터가 있는 페이지를 표시
            if ($total_count % $row_per_page != 0) {
                $last_page = $last_page + 1;
            }

            // 전체 페이지가 0개이면 현재 페이지도 0으로 표시
            if ($last_page == 0) {
                $current_page = 0;
            }

            // 내비게이션에 표시할 페이지 수
            $nav_per_page = 10;

            // 내비게이션 첫 번째 페이지
            $nav_first_page = $current_page - ($current_page % $nav_per_page) + 1;

            // 내비게이션 마지막 페이지
            $nav_last_page = $nav_first_page + $nav_per_page - 1;

            // 내비게이션 번호가 10으로 나누어 떨어지는 경우 처리하는 코드
            if ($current_page % $nav_per_page == 0 && $current_page != 0) {;
                $nav_first_page = $nav_first_page - $nav_per_page;
                $nav_last_page = $nav_last_page - $nav_per_page;
            }

            // 현재 페이지에 대한 이전 페이지
            if ($current_page > 10) {
                $pre_page =  $current_page - ($current_page % $nav_per_page) + 1 - 10;
            }
            else {
                $pre_page = 1;
            }

            // 현재 페이지에 대한 다음 페이지
            $next_page = $current_page - ($current_page % $nav_per_page) + 1 + 10;
            if ($next_page > $last_page) {
                $next_page = $last_page;
            }
        ?>
		<?php include  $_SERVER['DOCUMENT_ROOT']."/board/board_menu.php"; ?>
		<div class="container center">
			<br>
		
			<h1>게시물 목록</h1>
			
			<br>

			<button type="button" class="btn btn-sm btn-success" style="float: right;" onclick="location.href='/board/board_add_form.php'">작성</button>

			<br><br>
		    
		    <!-- 데이터 목록 -->
		    <table class="table table-hover center tb-fixed">
	        	<thead>
		        	<tr>
		                <th width="10%">번호</th>
						<th width="60%">제목</th>
						<th width="10%">작성자</th>
						<th width="20%">작성일</th>
		            </tr>
	        	</thead>
	            <tbody>
                    <?php
                        while($row = mysqli_fetch_array($list_result)) {
                    ?>
                        <tr>
							<!-- 번호, 제목, 작성자, 작성일, 조회수 -->
							<td><?php echo $row['board_no']; ?></td>
							<td class="msg-title"><a href="/board/board_view.php?board_no=<?php echo $row['board_no']; ?>"><?php echo $row['board_title']; ?></a></td>
							<td class="msg-writer"><?php echo $row['board_user']; ?></td>
							<td><?php echo $row['board_date']; ?></td>
                        </tr>
                    <?php
                        }
                    ?>
	            </tbody>
			</table>
			
			<br>
			
			<!-- 페이지 내비게이션 -->
			<ul class="pagination justify-content-center">
				<!-- 처음으로 버튼 -->
				<!-- current_page가 1보다 클 때만 처음으로 갈 수 있음 -->
                <?php 
                    if ($current_page > 1) {
                ?>
					<li class="page-item">
						<a class="page-link" href="./board_list.php?current_page=1">
							<i class='fas fa-angle-double-left'></i>
						</a>
                    </li>
                <?php
                    } else {
                ?>
				<!-- 첫 페이지 일 때 처음으로 버튼 표시 안 함 -->
					<li class="page-item disabled">
						<a class="page-link" href="#">
							<i class='fas fa-angle-double-left'></i>
						</a>
					</li>
                <?php
                    }
                ?>

				<!-- 이전 버튼 -->
                <!-- current_page가 1보다 클 때만 이전으로 갈 수 있음 -->
                <?php 
                    if ($current_page > 1) {
                ?>
					<li class="page-item">
						<a class="page-link" href="./board_list.php?current_page=<?php echo "$pre_page" ?>">
							<i class='fas fa-angle-left'></i>
						</a>
                    </li>
                <?php
                    } else {
                ?>
				<!-- 1이거나 그 이하면 버튼 표시 안 함 -->
					<li class="page-item disabled">
						<a class="page-link" href="#">
							<i class='fas fa-angle-left'></i>
						</a>
					</li>
                <?php
                    }
                ?>

				<!-- 현재 페이지 표시 -->
                <?php
                    for ($i = $nav_first_page; $i <= $nav_last_page; $i++) {
                        if ($i <= $last_page) {
                            if ($i == $current_page) {
                ?>
                                <li class="page-item active"><a class="page-link" href="#"><?php echo "$i" ?></a></li>
                <?php
                            } else {
                ?>
                                <li class="page-item"><a class="page-link" href="./board_list.php?current_page=<?php echo "$i" ?>"><?php echo "$i" ?></a></li>
                <?php
                            }
                        }
                    }
                ?>

				<!-- 다음 버튼 -->
				<!-- current_page가 last_page보다 작을 때만 다음으로 갈 수 있음 -->
				<?php 
                    if ($current_page < $last_page) {
                ?>
					<li class="page-item">
						<a class="page-link" href="./board_list.php?current_page=<?php echo "$next_page" ?>">
							<i class='fas fa-angle-right'></i>
						</a>
                    </li>
                <?php
                    } else {
                ?>
				<!-- 마지막 페이지 일 때 다음 버튼 표시 안 함 -->
					<li class="page-item disabled">
						<a class="page-link" href="#">
							<i class='fas fa-angle-right'></i>
						</a>
					</li>
                <?php
                    }
                ?>

				<!-- 마지막으로 버튼 -->
				<!-- current_page가 last_page보다 작을 때만 마지막으로 갈 수 있음 -->
				<?php 
                    if ($current_page < $last_page) {
                ?>
					<li class="page-item">
						<a class="page-link" href="./board_list.php?current_page=<?php echo "$last_page" ?>">
							<i class='fas fa-angle-double-right'></i>
						</a>
                    </li>
                <?php
                    } else {
                ?>
				<!-- 마지막 페이지 일 때 마지막으로 버튼 표시 안 함 -->
					<li class="page-item disabled">
						<a class="page-link" href="#">
							<i class='fas fa-angle-double-right'></i>
						</a>
					</li>
                <?php
                    }
                ?>
			</ul>
			
			<!-- 총 페이지 수 출력 -->
			<button type="button" class="btn btn-sm btn-dark"><?php echo $current_page ?> / <?php echo $last_page ?> 페이지</button>

			<br><br>
        </div>
	</body>
</html>