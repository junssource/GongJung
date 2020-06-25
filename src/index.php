<?php
  if(isset($_GET["page"]))
    $page = $_GET["page"];
  else
    $page = 1;

    if(isset($_GET["mode"]))
    $mode = $_GET["mode"];




  $db = mysqli_connect("localhost", "heo2020", "osdb@2020", "heo2020");

  $sql = "select * from board order by num desc";

  if(isset($mode)) {
    if($mode == "lib") {
  	     $sql = "select * from board where type='도서관' and (open='개방' or open='부분개방' or open='자료실개방') order by num desc";
    }
    if($mode == "mus") {
         $sql = "select * from board where type='박물관' and (open='개방' or open='부분개방' or open='사전예약개방' or open='제한적개방') order by num desc";
    }
    if($mode == "art") {
         $sql = "select * from board where type='미술관' and (open='개방' or open='부분개방' or open='사전예약개방' or open='제한적개방') order by num desc";
    }
    if($mode == "searchdate") {
      $date1 = $_GET["date1"];
      $date2 = $_GET["date2"];
      $sql = "select * from board where opendate between '$date1' and '$date2' order by num desc";
    }
    if($mode == "search") {
      $searchText = $_GET["query"];
      $sql = "select * from board where name like '%$searchText%' order by num desc";
    }
 }else{
   $mode = "main";
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

    <title>코로나 제주 공공기관 개방 정보</title>

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

        #search {
          width:70px;
          height:20px;
          font-size:10px;
        }

        #btn-search{
          font-size:10px;
        }

        #date-picker1{
          font-size:10px;
        }

        #date-picker2{
          font-size:10px;
        }

        button {
          border-width: 0.1px;
        }

        .label {margin-bottom: 96px;}
        .label * {display: inline-block;vertical-align: top;}
        .label .left {background: url("https://t1.daumcdn.net/localimg/localimages/07/2011/map/storeview/tip_l.png") no-repeat;display: inline-block;height: 24px;overflow: hidden;vertical-align: top;width: 7px;}
        .label .center {background: url(https://t1.daumcdn.net/localimg/localimages/07/2011/map/storeview/tip_bg.png) repeat-x;display: inline-block;height: 24px;font-size: 12px;line-height: 24px;}
        .label .right {background: url("https://t1.daumcdn.net/localimg/localimages/07/2011/map/storeview/tip_r.png") -1px 0  no-repeat;display: inline-block;height: 24px;overflow: hidden;width: 6px;}
        .wrap {position: absolute;left: 0;bottom: 40px;width: 288px;height: 132px;margin-left: -144px;text-align: left;overflow: hidden;font-size: 12px;font-family: 'Malgun Gothic', dotum, '돋움', sans-serif;line-height: 1.5;}
        .wrap * {padding: 0;margin: 0;}
        .wrap .info {width: 286px;height: 120px;border-radius: 5px;border-bottom: 2px solid #ccc;border-right: 1px solid #ccc;overflow: hidden;background: #fff;}
        .wrap .info:nth-child(1) {border: 0;box-shadow: 0px 1px 2px #888;}
        .info .title {padding: 5px 0 0 10px;height: 30px;background: #eee;border-bottom: 1px solid #ddd;font-size: 18px;font-weight: bold;}
        .info .close {position: absolute;top: 10px;right: 10px;color: #888;width: 17px;height: 17px;background: url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/overlay_close.png');}
        .info .close:hover {cursor: pointer;}
        .info .body {position: relative;overflow: hidden;}
        .info .desc {position: relative;margin: 13px 0 0 90px;height: 75px;}
        .desc .ellipsis {overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
        .desc .jibun {font-size: 11px;color: #888;margin-top: -2px;}
        .info .img {position: absolute;top: 6px;left: 5px;width: 73px;height: 71px;border: 1px solid #ddd;color: #888;overflow: hidden;}
        .info:after {content: '';position: absolute;margin-left: -12px;left: 50%;bottom: 0;width: 22px;height: 12px;background: url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png')}
        .info .link {color: #5085BB;}
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">코로나 제주 공공기관 개방 정보 
          </a>
          <small>현재 이용가능한 시설들을 알려드립니다.</small>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
        </div>
      </div>
    </nav>

    <div class="container">
  <button onclick="location.href='index.php'">전체</button>
  <button onclick="location.href='index.php?mode=lib'">도서관</button> 
  <button onclick="location.href='index.php?mode=mus'">박물관</button>
  <button onclick="location.href='index.php?mode=art'">미술관</button><br>

  <input type="text" placeholder="시설명" id="search" name="search" value="">
  <button id="btn-search" onclick="search()">시설명 검색</button>
  <input type="date" id="date-picker1" name="date1"> ~
  <input type="date" id="date-picker2" name="date2">
  <button id="btn-search" onclick="search_date()">기간 검색</button>
  <!-- &nbsp;&nbsp;<button>달력</button><br> -->

  <div>
  
  <table class="table table-sm table-hover">
      <thead class="thead-light">
        <tr>
          <th>번호</th>
          <th>유형</th>
          <th>시설명</th>
          <th>개관여부</th>
          <th>개관일</th>
          <th>수정일</th>
        </tr>
      </thead>
      <tbody>
        <?php

          $openArray = [];

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

              // if($open == "미개방") {
              //   $open = "<b>$open</b>";
              // }

              if($open == "개방" || $open == "부분개방" || $open == "자료실개방" || $open == "사전예약개방" || $open == "제한적개방") {
                $openArray[$num] = $num;
              }

              // echo "$openArray[$num]";

          ?>
          <tr>
            <td><?=$num?></td>
            <td><?=$type?></td>
            <td><?=$name?></td>
            <td><?=$open?></td>
            <td><?=$opendate?></td>
            <td><?=$changed?></td>
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
                if($mode == "searchdate") {
                  echo  "<a href='index.php?mode=$mode&page=$new_page&date1=$date1&date2=$date2'><small>이전</small></a>";
                }else{ 
                echo "<a href='index.php?mode=$mode&page=$new_page'><small>이전</small></a>";
                }
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

                if($mode == "searchdate") {
                  echo  "<a href='index.php?mode=$mode&page=$new_page&date1=$date1&date2=$date2'><small>다음</small></a>";
                }else{
                echo "<a href='index.php?mode=$mode&page=$new_page'><small>다음</small></a>";
                }

              }else{
                  echo "<a href=#><small>다음</small></a>";
              }

            ?>
            <br><br>
        <div id="kakao-map" style="width:1100px; height:500px;"></div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=eafee2dc00b76404af16ce3887a3605b"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=eafee2dc00b76404af16ce3887a3605b&libraries=LIBRARY"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=eafee2dc00b76404af16ce3887a3605b&libraries=services"></script>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=eafee2dc00b76404af16ce3887a3605b&libraries=services,clusterer,drawing"></script>
    <script src="json/lib.js"></script>
    <script>
        var container = document.getElementById('kakao-map'); //지도를 담을 영역의 DOM 레퍼런스
        var options = { //지도를 생성할 때 필요한 기본 옵션
        center: new kakao.maps.LatLng(33.450701, 126.570667), //지도의 중심좌표.
        level: 10 //지도의 레벨(확대, 축소 정도)
        };

        var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴

        // var imageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_red.png', // 마커이미지의 주소입니다    
        // imageSize = new kakao.maps.Size(64, 69), // 마커이미지의 크기입니다
        // imageOption = {offset: new kakao.maps.Point(27, 69)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
        // var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);

        // 지도에 마커를 표시합니다 

        var positions = [
    {
        content: '<div>테스트</div>', 
        content2: '테스트',
        latlng: new kakao.maps.LatLng(halla.위도, halla.경도) // 0
    },
    {
        content: '<div>한라도서관<br>'+halla.홈페이지주소+'<br>'+halla.도서관전화번호+'</div>', 
        content2: '한라도서관',
        latlng: new kakao.maps.LatLng(halla.위도, halla.경도) // 1
    },
    {
        content: '<div>우당도서관<br>'+woodang.홈페이지주소+'<br>'+woodang.도서관전화번호+'</div>', 
        content2: '우당도서관',
        latlng: new kakao.maps.LatLng(woodang.위도, woodang.경도) // 2
    },
    {
        content: '<div>제주기적의도서관<br>'+j_gijeok.홈페이지주소+'<br>'+j_gijeok.도서관전화번호+'</div>', 
        content2: '제주기적의도서관',
        latlng: new kakao.maps.LatLng(j_gijeok.위도, j_gijeok.경도) // 3
    },
    {
        content: '<div>조천읍도서관<br>'+jocheon.홈페이지주소+'<br>'+jocheon.도서관전화번호+'</div>',
        content2: '조천읍도서관',
        latlng: new kakao.maps.LatLng(jocheon.위도, jocheon.경도) // 4
    },
    {
        content: '<div>탐라도서관<br>'+tamra.홈페이지주소+'<br>'+tamra.도서관전화번호+'</div>',
        content2:'탐라도서관',
        latlng: new kakao.maps.LatLng(tamra.위도,tamra.경도) // 5
    },
    {
        content: '<div>애월도서관<br>'+aewol.홈페이지주소+'<br>'+aewol.도서관전화번호+'</div>',
        content2: '애월도서관',
        latlng: new kakao.maps.LatLng(aewol.위도,aewol.경도) // 6
    },
    {
        content: '<div>한경도서관<br>'+hankyung.홈페이지주소+'<br>'+hankyung.도서관전화번호+'</div>',
        content2: '한경도서관',
        latlng: new kakao.maps.LatLng(hankyung.위도,hankyung.경도) // 7
    },
    {
        content: '<div>삼매봉도서관<br>'+samme.홈페이지주소+'<br>'+samme.도서관전화번호+'</div>', // 8
        content2: '삼매봉도서관',
        latlng: new kakao.maps.LatLng(samme.위도,samme.경도)
    },
    {
        content: '<div>중앙도서관<br>'+jungang.홈페이지주소+'<br>'+jungang.도서관전화번호+'</div>', // 9
        content2: '중앙도서관',
        latlng: new kakao.maps.LatLng(jungang.위도,jungang.경도)
    },
    {
        content: '<div>동부도서관<br>'+dongbu.홈페이지주소+'<br>'+dongbu.도서관전화번호+'</div>', // 10
        content2: '동부도서관',
        latlng: new kakao.maps.LatLng(dongbu.위도,dongbu.경도)
    },
    {
        content: '<div>서부도서관<br>'+seobu.홈페이지주소+'<br>'+seobu.도서관전화번호+'</div>', // 11
        content2: '서부도서관',
        latlng: new kakao.maps.LatLng(seobu.위도,seobu.경도)
    },
    {
        content: '<div>서귀포기적의도서관<br>'+s_gijeok.홈페이지주소+'<br>'+s_gijeok.도서관전화번호+'</div>', // 12
        content2: '서귀포기적의도서관',
        latlng: new kakao.maps.LatLng(s_gijeok.위도,s_gijeok.경도)
    },
    {
        content: '<div>성산일출도서관<br>'+sungsan.홈페이지주소+'<br>'+sungsan.도서관전화번호+'</div>', // 13
        content2:'성산일출도서관',
        latlng: new kakao.maps.LatLng(sungsan.위도,sungsan.경도)
    },
    {
        content: '<div>안덕산방도서관<br>'+ahndeok.홈페이지주소+'<br>'+ahndeok.도서관전화번호+'</div>', // 14
        content2:'안덕산방도서관',
        latlng: new kakao.maps.LatLng(ahndeok.위도,ahndeok.경도)
    },
    {
        content: '<div>표선도서관<br>'+pyosun.홈페이지주소+'<br>'+pyosun.도서관전화번호+'</div>', // 15
        content2:'표선도서관',
        latlng: new kakao.maps.LatLng(pyosun.위도,pyosun.경도)
    },
    {
        content: '<div>제주도서관<br>'+jejulib.홈페이지주소+'<br>'+jejulib.도서관전화번호+'</div>', // 16
        content2:'제주도서관',
        latlng: new kakao.maps.LatLng(jejulib.위도,jejulib.경도)
    },
    {
        content: '<div>서귀포도서관<br>'+seogipolib.홈페이지주소+'<br>'+seogipolib.도서관전화번호+'</div>', //17
        content2:'서귀포도서관',
        latlng: new kakao.maps.LatLng(seogipolib.위도,seogipolib.경도)
    },
    {
        content: '<div>한수풀도서관<br>'+hansupool.홈페이지주소+'<br>'+hansupool.도서관전화번호+'</div>', // 18
        content2:'한수풀도서관',
        latlng: new kakao.maps.LatLng(hansupool.위도,hansupool.경도)
    },
    {
        content: '<div>동녘도서관<br>'+dongnyeok.홈페이지주소+'<br>'+dongnyeok.도서관전화번호+'</div>', // 19
        content2:'동녘도서관',
        latlng: new kakao.maps.LatLng(dongnyeok.위도,dongnyeok.경도)
    },
    {
        content: '<div>송악도서관<br>'+songark.홈페이지주소+'<br>'+songark.도서관전화번호+'</div>', // 20
        content2:'송악도서관',
        latlng: new kakao.maps.LatLng(songark.위도,songark.경도)
    },
    {
        content: '<div>제남도서관<br>'+jenam.홈페이지주소+'<br>'+jenam.도서관전화번호+'</div>', // 21
        content2:'제남도서관',
        latlng: new kakao.maps.LatLng(jenam.위도,jenam.경도)
    },
    {
        content: '<div>국립제주박물관<br>'+jejuMuseum.운영홈페이지+'<br>'+jejuMuseum.운영기관전화번호+'</div>', // 22
        latlng: new kakao.maps.LatLng(jejuMuseum.위도,jejuMuseum.경도)
    },
    {
        content: '<div>민속자연사박물관<br>'+minsokNature.운영홈페이지+'<br>'+minsokNature.운영기관전화번호+'</div>', // 23
        latlng: new kakao.maps.LatLng(minsokNature.위도,minsokNature.경도)
    },
    {
        content: '<div>제주교육박물관<br>'+eduMuseum.운영홈페이지+'<br>'+eduMuseum.운영기관전화번호+'</div>', // 24
        latlng: new kakao.maps.LatLng(eduMuseum.위도, eduMuseum.경도)
    },
    {
        content: '<div>제주민속촌<br>'+minsokchon.운영홈페이지+'<br>'+minsokchon.운영기관전화번호+'</div>', // 25
        latlng: new kakao.maps.LatLng(minsokchon.위도,minsokchon.경도)
    },
    {
        content: '<div>제주대학교박물관<br>'+jejuUnivMuseum.운영홈페이지+'<br>'+jejuUnivMuseum.운영기관전화번호+'</div>', // 26
        latlng: new kakao.maps.LatLng(jejuUnivMuseum.위도,jejuUnivMuseum.경도)
    },
    {
        content: '<div>제주평화박물관<br>'+jejuPeace.운영홈페이지+'<br>'+jejuPeace.운영기관전화번호+'</div>', // 27
        latlng: new kakao.maps.LatLng(jejuPeace.위도,jejuPeace.경도)
    },
    {
        content: '<div>감귤박물관<br>'+gamgule.운영홈페이지+'<br>'+gamgule.운영기관전화번호+'</div>', // 28
        latlng: new kakao.maps.LatLng(gamgule.위도,gamgule.경도)
    },
    {
        content: '<div>제주돌박물관<br>'+jejudol.운영홈페이지+'<br>'+jejudol.운영기관전화번호+'</div>', // 29
        latlng: new kakao.maps.LatLng(jejudol.위도,jejudol.경도)
    },
    {
        content: '<div>해녀박물관<br>'+haenyeo.운영홈페이지+'<br>'+haenyeo.운영기관전화번호+'</div>', // 30
        latlng: new kakao.maps.LatLng(haenyeo.위도,haenyeo.경도)
    },
    {
        content: '<div>김만덕기념관<br>'+kimmandeok.운영홈페이지+'<br>'+kimmandeok.운영기관전화번호+'</div>', // 31
        latlng: new kakao.maps.LatLng(kimmandeok.위도,kimmandeok.경도)
    },
    {
        content: '<div>제주4.3평화기념관<br>'+jeju43.운영홈페이지+'<br>'+jeju43.운영기관전화번호+'</div>', // 32
        latlng: new kakao.maps.LatLng(jeju43.위도,jeju43.경도)
    },
    {
        content: '<div>설문대전시관<br>'+sulmoondae.운영홈페이지+'<br>'+sulmoondae.운영기관전화번호+'</div>', // 33
        latlng: new kakao.maps.LatLng(sulmoondae.위도,sulmoondae.경도)
    },
    {
        content: '<div>기당미술관<br>'+gidangArt.운영홈페이지+'<br>'+gidangArt.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(gidangArt.위도,gidangArt.경도)
    },
    {
        content: '<div>이중섭미술관<br>'+leejungseop.운영홈페이지+'<br>'+leejungseop.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(leejungseop.위도,leejungseop.경도)
    },
    {
        content: '<div>김영갑갤러리<br>'+kimyeonggab.운영홈페이지+'<br>'+kimyeonggab.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(kimyeonggab.위도,kimyeonggab.경도)
    },
    {
        content: '<div>자연사랑미술관<br>'+naturelove.운영홈페이지+'<br>'+naturelove.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(naturelove.위도,naturelove.경도)
    },
    {
        content: '<div>러브랜드미술관<br>'+loveland.운영홈페이지+'<br>'+loveland.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(loveland.위도,loveland.경도)
    },
    {
        content: '<div>제주 현대미술관<br>'+hyundae.운영홈페이지+'<br>'+hyundae.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(hyundae.위도,hyundae.경도)
    },
    {
        content: '<div>제주 조각공원<br>'+jogakPark.운영홈페이지+'<br>'+jogakPark.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(jogakPark.위도,jogakPark.경도)
    },
    {
        content: '<div>제주도립 김창렬미술관<br>'+kimchangyul.운영홈페이지+'<br>'+kimchangyul.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(kimchangyul.위도,kimchangyul.경도)
    },
    {
        content: '<div>제주도립미술관<br>'+dorip.운영홈페이지+'<br>'+dorip.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(dorip.위도,dorip.경도)
    },
    {
        content: '<div>왈종미술관<br>'+waljongArt.운영홈페이지+'<br>'+waljongArt.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(waljongArt.위도,waljongArt.경도)
    },
    {
        content: '<div>성안미술관<br>'+sungahnArt.운영홈페이지+'<br>'+sungahnArt.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(sungahnArt.위도,sungahnArt.경도)
    },
    {
        content: '<div>유민미술관<br>'+yuminArt.운영홈페이지+'<br>'+yuminArt.운영기관전화번호+'</div>', // 34
        latlng: new kakao.maps.LatLng(yuminArt.위도,yuminArt.경도)
    }
];   
       
    </script>

<?php

if($mode == "lib") {

?>

<script>
var js_array = [];
js_array = <?php echo json_encode($openArray)?>; 

// 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다 
  

  var obj_length = Object.keys(js_array).length;

  for(var i=0; i<=100; i++) {

    var send = js_array[i];
    makeMarker(send);
  }

    // 마커를 생성합니다

  function makeMarker(send) {

    if(send == undefined) return;
    
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[send].latlng // 마커의 위치
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[send].content // 인포윈도우에 표시할 내용
    });

    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
  }


// 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
function makeOverListener(map, marker, infowindow) {
    return function() {
        infowindow.open(map, marker);
    };
}

// 인포윈도우를 닫는 클로저를 만드는 함수입니다 
function makeOutListener(infowindow) {
    return function() {
        infowindow.close();
    };
}


</script>

<?php
} if($mode == "mus") {
?>
<script>
 js_array = <?php echo json_encode($openArray)?>;
 
 obj_length = Object.keys(js_array).length;

  for(var i=0; i<=100; i++) {

    var send = js_array[i];
    makeMarker(send);
  }

  function makeMarker(send) {
    
    if(send == undefined) return;
    
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[send].latlng // 마커의 위치
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[send].content // 인포윈도우에 표시할 내용
    });

    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
  }


// 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
function makeOverListener(map, marker, infowindow) {
    return function() {
        infowindow.open(map, marker);
    };
}

// 인포윈도우를 닫는 클로저를 만드는 함수입니다 
function makeOutListener(infowindow) {
    return function() {
        infowindow.close();
    };
}

  
  
</script>

<?php
} if($mode == "art") {
?>
<script>

js_array = <?php echo json_encode($openArray)?>;
 
 obj_length = Object.keys(js_array).length;

  for(var i=0; i<=100; i++) {

    var send = js_array[i];
    makeMarker(send);
  }

  function makeMarker(send) {
    
    if(send == undefined) return;
    
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[send].latlng // 마커의 위치
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[send].content // 인포윈도우에 표시할 내용
    });

    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
  }


// 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
function makeOverListener(map, marker, infowindow) {
    return function() {
        infowindow.open(map, marker);
    };
}

// 인포윈도우를 닫는 클로저를 만드는 함수입니다 
function makeOutListener(infowindow) {
    return function() {
        infowindow.close();
    };
}


</script>
<?php
} if($mode == "search") {
?>
<script>
  js_array = <?php echo json_encode($openArray)?>;
 
 obj_length = Object.keys(js_array).length;

  for(var i=0; i<=100; i++) {

    var send = js_array[i];
    makeMarker(send);
  }

  function makeMarker(send) {
    
    if(send == undefined) return;
    
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[send].latlng // 마커의 위치
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[send].content // 인포윈도우에 표시할 내용
    });

    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
  }


    // 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
    function makeOverListener(map, marker, infowindow) {
        return function() {
            infowindow.open(map, marker);
        };
    }

    // 인포윈도우를 닫는 클로저를 만드는 함수입니다 
    function makeOutListener(infowindow) {
        return function() {
            infowindow.close();
        };
    }

</script>
<?php
} if($mode == "searchdate") {
?>
<script>
  js_array = <?php echo json_encode($openArray)?>;
 
 obj_length = Object.keys(js_array).length;

  for(var i=0; i<=100; i++) {

    var send = js_array[i];
    makeMarker(send);
  }

  function makeMarker(send) {
    
    if(send == undefined) return;
    
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[send].latlng // 마커의 위치
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[send].content // 인포윈도우에 표시할 내용
    });

    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
  }


    // 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
    function makeOverListener(map, marker, infowindow) {
        return function() {
            infowindow.open(map, marker);
        };
    }

    // 인포윈도우를 닫는 클로저를 만드는 함수입니다 
    function makeOutListener(infowindow) {
        return function() {
            infowindow.close();
        };
    }

</script>
<?php } ?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <!--   <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
   <script>
        function search() {
          var searchText = document.getElementById("search").value;
          console.log(searchText);

          window.location.href = "index.php?mode=search&query=" + searchText;
        }

        function search_date() {
          var date1 = document.getElementById("date-picker1").value;
          var date2 = document.getElementById("date-picker2").value;
          console.log(date1);
          console.log(date2);

          window.location.href = "index.php?mode=searchdate&date1=" + date1 + "&date2=" + date2;
        }
   </script>
   
  </body>
</html>
