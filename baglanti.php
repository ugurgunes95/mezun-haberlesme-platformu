<?php
	session_start();
	ob_start();
	$baglanti=mysql_connect("localhost","root","12345678");
	mysql_select_db("mezun",$baglanti);
	mysql_query("SET NAMES 'utf8'");
	mysql_query("Set character set 'utf8'");
	mysql_query("Set collation_connection= 'utf8_turkish_ci'");

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
ob_end_flush();
?>
</html>