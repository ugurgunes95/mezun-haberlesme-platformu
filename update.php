<?php
	session_start();
	ob_start();
	
	include("baglanti.php");
	
	$ad=$_POST[newName];
	$soyad=$_POST[newLastname];
	$email=$_POST[newMail];
	$sifre=$_POST[newPass];
	
	$dosya_adi=$_FILES["newPP"]["name"];
	$dosya_uzanti=$_FILES["newPP"]["type"];
	if($_POST)
	{
		if($_FILES["newPP"]["size"]>1024*512)
		{
			$dizi=Array("ab","cd","ef","gh","ij","kl","mn");
			$rndsayi=rand(1,10000);
			$yeniAd="pp/".$dizi[rand(0,6)].$rndsayi.".".substr($dosya_uzanti,6);
			if(move_uploaded_file($_FILES["newPP"]["tmp_name"],$yeniAd))
			{
				
			}
		}
	}
	$a="SELECT * FROM users WHERE id='$_SESSION[kullanici]';";
	$b=mysql_query($a,$baglanti);
	while($c=mysql_fetch_array($b))
	{
		if($ad=='')
			$ad=$c[ad];
		if($soyad=='')
			$soyad=$c[soyad];
		if($email=='')
			$email=$c[eposta];
		if($sifre=='')
			$sifre=$c[sifre];
		if($yeniAd=='')
			$yeniAd=$c[pp];
	}
	
	$SQL_guncelle="UPDATE users SET ad='$ad',soyad='$soyad',eposta='$email',sifre='$sifre',pp='$yeniAd' WHERE id='$_SESSION[kullanici]';";
	
	
	mysql_query($SQL_guncelle,$baglanti);
	header("Location:index.php?menu=2");
	ob_end_flush();
?>
<html>
    <head>
        <meta http-equiv="refresh" content="3;URL=index.php">
    </head>
</html>