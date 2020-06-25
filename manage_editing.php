<?php
$num = $_POST["num"];
$open = $_POST["open"];
$opendate = $_POST["opendate"];
$changed = date("Y-m-d");

echo "MySql 연결 테스트<br>";

$db = mysqli_connect("localhost", "root", "", "test");

if($db){
    echo "connect : 성공<br>";
}
else{
    echo "disconnect : 실패<br>";
}

$sql = "update board set open='$open', opendate='$opendate', changed='$changed'";
$sql .= " where num=$num";

mysqli_query($db,$sql);

mysqli_close($db);
echo "$num <br>";
echo "$open <br>";
echo "$opendate <br>";

echo "
		<script>
			location.href='manage_demo.php';
		</script>
	"

?>