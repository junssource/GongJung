<?php

$type = $_POST["type"];
$name = $_POST["name"];
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

$sql = "INSERT INTO board(type,name,open,opendate,changed)
						     VALUES ('$type','$name','$open','$opendate','$changed')";
 
$result = mysqli_query($db,$sql);
mysqli_close($db);

	echo "
		<script>
			location.href='manage_demo.php';
		</script>
	"
?>
