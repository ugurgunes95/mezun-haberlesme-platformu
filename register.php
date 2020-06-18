<?php
	session_start();
	ob_start();
	
	include("baglanti.php");
	
	$ad=$_POST[userName];
	$soyad=$_POST[userLastname];
	$email=$_POST[userEmail];
	$sifre=$_POST[userPass];
	
	$dosya_adi=$_FILES["userPicture"]["name"];
	$dosya_uzanti=$_FILES["userPicture"]["type"];
	if($_POST)
	{
		if($_FILES[userPicture][size]>1024*512)
		{
			$dizi=Array("ab","cd","ef","gh","ij","kl","mn");
			$rndsayi=rand(1,10000);
			$yeniAd="pp/".$dizi[rand(0,6)].$rndsayi.".".substr($dosya_uzanti,6);
			if(move_uploaded_file($_FILES["userPicture"]["tmp_name"],$yeniAd))
			{
				
			}
		}
	}
	if($ad!='' && $soyad!='' && $email!='' && $sifre!='')
	{
		$SQL_kayit="INSERT INTO users(ad,soyad,eposta,sifre,pp) VALUES('$ad','$soyad','$email','$sifre','$yeniAd');";
		mysql_query($SQL_kayit,$baglanti);
		header("Location:index.php");
	}
	else
    {
        echo "Eksik veya hatali veri girdiniz. Anasayfaya yönlendiriliyorsunuz..";
    }
	ob_end_flush();
?>
<html>
    <head>
        <meta http-equiv="refresh" content="3;URL=index.php">
    </head>
</html>