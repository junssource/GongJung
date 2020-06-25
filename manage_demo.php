<?php
	if(isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;


  if(isset($_GET["mode"]))
    $mode = $_GET["mode"];

	$db = mysqli_connect("localhost", "root", "", "test");

  $sql = "select * from board order by num desc";

  if(isset($mode)) {
    if($mode == "lib") {
  	     $sql = "select * from board where type='도서관' order by num desc";
    }
    if($mode == "mus") {
         $sql = "select * from board where type='박물관' order by num desc";
    }
    if($mode == "art") {
         $sql = "select * from board where type='미술관' order by num desc";
    }
 }

	$result = mysqli_query($db,$sql);
	$total_record = mysqli_num_rows($result);

  $scale = 10;

  if($total_record % $scale == 0)
    $total_page = floor($total_record/$scale);
  else
    $total_page = floor($total_record/$scale) + 1;

  $start = ($page - 1) * $scale;
  $number = $total_record - $start;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
   <!--  <link href="starter-template.css" rel="stylesheet"> -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
   <!--  <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        tr, th{
          font-size:10px;
        }

        button{
          font-size:10px;
        }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">코로나 제주 공공기관 개방 정보 
          </a>
          <small>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">메인</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="manage_insert.php">입력</a></small>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
        </div>
      </div>
    </nav>

    <div class="container">
  <button onclick="location.href='manage_demo.php?mode=lib'">도서관</button>
  <button onclick="location.href='manage_demo.php?mode=mus'">박물관</button>
  <button onclick="location.href='manage_demo.php?mode=art'">미술관</button>
  
  <table class="table table-sm table-hover">
        <thead class="thead-light">
          <tr>
            <th>번호</th>
            <th>유형</th>
            <th>시설명</th>
            <th>개관여부</th>
            <th>개관일</th>
            <th>수정일</th>
            <th>관리</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($i=$start; $i<$start+$scale && $i<$total_record; $i++)
            {
              mysqli_data_seek($result, $i);

              $row = mysqli_fetch_array($result);

              $num = $row["num"];
              $type = $row["type"];
              $name = $row["name"];
              $open = $row["open"];
              $opendate = $row["opendate"];
              $changed = $row["changed"];
          ?>
          <tr>
            <td><?=$num?></td>
            <td><?=$type?></td>
            <td><?=$name?></td>
            <td><?=$open?></td>
            <td><?=$opendate?></td>
            <td><?=$changed?></td>
            <td><a href="manage_edit.php?num=<?=$num?>&type=<?=$type?>&name=<?=$name?>&open=<?=$open?>&opendate=<?=$opendate?>&changed=<?=$changed?>">
            관리</a></td>
          </tr>
          <?php
            $number--;
          }
          mysqli_close($db);
          ?>
        </tbody>
      </table>
            <?php
              if($total_page >= 2 && $page >= 2){

                $new_page = $page-1;
                echo "<a href='manage_demo.php?page=$new_page'><small>이전</small></a>";
              }else{
                echo "<a href=#><small>이전</small></a>";
              }

              for($i=1; $i<=$total_page; $i++){

                if($page == $i){

                  echo "<small>&nbsp; $i &nbsp;</small>";

                }else{

                  echo "";
                }
              }

              if($total_page >= 2 && $page != $total_page){

                $new_page = $page+1;
                echo "<a href='manage_demo.php?page=$new_page'><small>다음</small></a>";

              }else{
                  echo "<a href=#><small>다음</small></a>";
              }

            ?>
       
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=eafee2dc00b76404af16ce3887a3605b"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <!--   <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>
