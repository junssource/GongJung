<?php
	$num = $_GET["num"];

	$db = mysqli_connect("localhost", "root", "", "test");
	$sql = "select * from board where num = $num";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result);

	$sql = "delete from board where num = $num";
	mysqli_query($db, $sql);
	mysqli_close($db);
?>