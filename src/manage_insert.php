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

        form{
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
      <h5>입력 UI</h5>
      <hr />
      <form
        name="insert_form"
        method="post"
        action="manage_inserting.php"
        onsubmit="return check_input();"
      >
        시설유형 <input type="text" name="type" /><br /><br />
        시설명 <input type="text" name="name" /><br /><br />
        개방여부 <input type="text" name="open" /><br /><br />
        개방예정일 <input type="text" name="opendate" /><br /><br />
        <input type="submit" name="submit" value="입력" />
      </form>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=eafee2dc00b76404af16ce3887a3605b"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <!--   <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  <script>
      function check_input() {
        if (!document.insert_form.type.value) {
          alert("시설유형을 입력하세요!");
          return false;
        }
        if (!document.insert_form.name.value) {
          alert("시설명을 입력하세요!");
          return false;
        }
        if (!document.insert_form.open.value) {
          alert("개방여부를 입력하세요!");
          return false;
        }
        if (!document.insert_form.opendate.value) {
          alert("개방예정일을 입력하세요!");
          return false;
        }
        if (!document.insert_form.changed.value) {
          alert("업데이트일을 입력하세요!");
          return false;
        }
        document.insert_form.submit();
      }
    </script>
  </body>
</html>
