<?php
	session_start();
	ob_start();
	include("baglanti.php");
	
	$sayac=0;
	$user=$_POST["user"];
	$pass=$_POST["pass"];
	
	$sss="SELECT * FROM users WHERE eposta='$user' AND sifre='$pass';";
	$sorguu=mysql_query($sss,$baglanti);
	while($soonuc=mysql_fetch_array($sorguu))
	{
		$sayac++;
		$_SESSION["kullanici"]=$soonuc[id];
		$_SESSION["ad"]=$soonuc[ad];
		$_SESSION["soyad"]=$soonuc[soyad];
	}
	
	if($sayac>1)
	{
		$_SESSION["kullanici"]=0;
		header("Location:index.php");
	}
	
	else
	{
		header("Location:index.php");
	}
	
	ob_end_flush();
?>