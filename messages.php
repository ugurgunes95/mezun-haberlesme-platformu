<html>
<?php
	session_start();
	ob_start();
	
	include("baglanti.php");
	
	if(isset($_POST['gndr']))
	{
		$gonderen=$_SESSION["kullanici"];
		$gondKonu=$_POST[topic];
		$gondMesaj=$_POST[post];
		$alici=$_SESSION["secilenmsg"];
		
		$SQL_message="INSERT INTO messages (gonderen_id,alici_id,konu,icerik) VALUES('$gonderen','$alici','$gondKonu','$gondMesaj');";
		mysql_query($SQL_message,$baglanti);
		header("Location:index.php");
	}
?>
<head>
<script type="text/javascript">
function goo(a)
{
window.location = "index.php?msgSecilen="+a.value;
}
</script>
<style type="text/css">
	table{
		border-collapse:collapse;
	}
	table thead th{
		border-bottom: 1px solid #000;
		}
</style>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>All Template Needs</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="css/custom-styles.css">
    <link rel="stylesheet" href="css/font-awesome.css">
	
     
	 <link rel="stylesheet" href="css/demo.css">
    <link rel="stylesheet" href="css/font-awesome-ie7.css">

</head>
    <div class="container">
    <div class="featured-block">
		<table border="0">
			<tr colspan="3">
				<td style="width:120px;"><b><a href="index.php?num=1">Mesaj Yaz..</a></b></td>
				<th rowspan="3" style="width:200px;">&nbsp;</th>;
				<th rowspan="3" style="width:520px;">
					<?php
					if($_SESSION[message]==1)
					{
						echo "<span>Mesaj atmak istediğiniz kişiyi seçin..</span>";
						
						echo "<select name=\"msgSecilen\" onchange=\"javascript:goo(this)\">";
						$SQL_users="SELECt * FROM users WHERE id<>'$_SESSION[kullanici]';";
						$sorgu_users=mysql_query($SQL_users,$baglanti);
						echo "<option value=\"0\">Kullanıcı seçiniz..</option>";
						while($sonuc_users=mysql_fetch_array($sorgu_users))
						{
							echo "<option value=\"$sonuc_users[id]\">".$sonuc_users[ad]." "."$sonuc_users[soyad]</option>";
						}
						echo "</select>";
					}
					if($_SESSION[secilenmsg]!='')
					{
						echo "<div class=\"col-md\">";
						echo "<form action=\"messages.php\" method=\"POST\">";
							echo "<input type=\"text\" name=\"topic\" placeholder=\"Konu\" style=\"width:420px;\" required><br>";
							echo "<textarea name=\"post\" rows=\"4\" cols=\"50\" placeholder=\"Mesajınızı bu alana giriniz..\" required>";
							echo "</textarea>";
							echo "<br><center><input type=\"submit\" name=\"gndr\" class=\"btn btn-light\"></center>";
						echo "</form>";
						echo "</div>";
					}
					if($_SESSION[message]==2)
					{
						if($_SESSION["msgSayisi"]>0){
						$sayac=0;
						$SQL_gelenler="SELECT * FROM messages WHERE alici_id='$_SESSION[kullanici]';";
						$SQL_gonderen="SELECT * FROM messages m, users u WHERE m.gonderen_id=u.id";
						$sorgu_gelenler=mysql_query($SQL_gelenler,$baglanti);
						
						echo "<table border=\"0\">";
						echo "<tr bgcolor=\"#0fa\">
						<td align=\"center\"style=\"width:250px;\" >Gönderen</td>
						<td align=\"center\"style=\"width:200px;\" >Konu</td>
						<td align=\"right\">&nbsp;</td>
						<td align=\"right\" style=\"width:300px;\">Mesaj</td>
						<td style=\"width:300px;\">&nbsp;</td>
						</tr>";
						while($gelenler=mysql_fetch_array($sorgu_gelenler))
						{
							if($gelenler[durum]==0)
							{
							$SQL_gonderen="SELECT * FROM users WHERE '$gelenler[gonderen_id]'=id";
							$gon=mysql_query($SQL_gonderen,$baglanti);
							
							while($son=mysql_fetch_array($gon))
							{
								$ad=$son[ad];
								$soyad=$son[soyad];
								$kull=$son[id];
							}
							if($sayac%2==0){
								$bgcol="#fe1";
								$bgcol2="#ffa";
							}
							else{
								$bgcol="#ab5";
								$bgcol2="#aaf";
							}
							echo "<tr>";
							echo "<td style=\"width:250px;\" >".$ad." ".$soyad."</td>
							<td style=\"width:200px;\" bgcolor=\"$bgcol\"><b>$gelenler[konu]<b></td>
							<td bgcolor=\"$bgcol2\">&nbsp;</td>
							<td align=\"right\" style=\"width:300px;\" bgcolor=\"$bgcol2\">$gelenler[icerik]</td>";
							$sayac++;
							mysql_query("UPDATE messages SET durum='1' WHERE alici_id='$_SESSION[kullanici]';",$baglanti);
							echo "<td><a href=\"index.php?msgSecilen=$kull\">Cevapla</a></td>";
							echo "</tr>";
						}
						}
						echo "</table>";
						}
						else
							echo " Yeni mesajınız bulunmamaktadır.";
					}
					if($_SESSION[message]==3)
					{
						$sayac=0;
						$SQL_gidenler="SELECT * FROM messages WHERE gonderen_id='$_SESSION[kullanici]';";
						$SQL_alan="SELECT * FROM messages m, users u WHERE m.alici_id=u.id";
						$sorgu_gidenler=mysql_query($SQL_gidenler,$baglanti);
						
						echo "<table border=\"0\">";
						echo "<tr bgcolor=\"#0fa\">
						<td align=\"center\"style=\"width:250px;\" >Alıcı</td>
						<td align=\"center\"style=\"width:200px;\" >Konu</td>
						<td align=\"right\">&nbsp;</td>
						<td align=\"right\" style=\"width:300px;\">Mesaj</td>
						<td align=\"right\">&nbsp;</td>
						<td align=\"right\" style=\"width:300px;\">Durum</td>
						</tr>";
						while($gidenler=mysql_fetch_array($sorgu_gidenler))
						{
							$SQL_alan="SELECT * FROM users WHERE '$gidenler[alici_id]'=id";
							$git=mysql_query($SQL_alan,$baglanti);
							while($son2=mysql_fetch_array($git))
							{
								$ad=$son2[ad];
								$soyad=$son2[soyad];
							}
							if($sayac%2==0){
								$bgcol="#fe1";
								$bgcol2="#ffa";
							}
							else{
								$bgcol="#ab5";
								$bgcol2="#aaf";
							}
							echo "<td></td>";
						
							echo "<tr>";
							echo "<td style=\"width:250px;\" >".$ad." ".$soyad."</td>
							<td style=\"width:200px;\" bgcolor=\"$bgcol\"><b>$gidenler[konu]<b></td>
							<td bgcolor=\"$bgcol2\">&nbsp;</td>
							<td align=\"right\" style=\"width:300px;\" bgcolor=\"$bgcol2\">$gidenler[icerik]</td>";
							$sayac++;
							echo "<td>&nbsp;</td>";
							echo "<td align=\"right\" style=\"width:75px;\">";
								if($gidenler[durum]==1)
									echo "Okundu";
								else
									echo "Okunmadı";
								echo "</td>";
						}
						echo "</table>";
					}
					if($_SESSION[message]==4)
					{
						$sayac=0;
						$SQL_arsiv="SELECT * FROM messages WHERE alici_id='$_SESSION[kullanici]';";
						$SQL_gonderen="SELECT * FROM messages m, users u WHERE m.gonderen_id=u.id";
						$sorgu_arsiv=mysql_query($SQL_arsiv,$baglanti);
						
						echo "<table border=\"0\">";
						echo "<tr bgcolor=\"#0fa\">
						<td align=\"center\"style=\"width:250px;\" >Gönderen</td>
						<td align=\"center\"style=\"width:200px;\" >Konu</td>
						<td align=\"right\">&nbsp;</td>
						<td align=\"right\" style=\"width:300px;\">Mesaj</td>
						</tr>";
						while($arsiv=mysql_fetch_array($sorgu_arsiv))
						{
							if($arsiv[durum]==1)
							{
							$SQL_arsiv="SELECT * FROM users WHERE '$arsiv[gonderen_id]'=id";
							$ars=mysql_query($SQL_arsiv,$baglanti);
							while($son3=mysql_fetch_array($ars))
							{
								$ad=$son3[ad];
								$soyad=$son3[soyad];
							}
							if($sayac%2==0){
								$bgcol="#fe1";
								$bgcol2="#ffa";
							}
							else{
								$bgcol="#ab5";
								$bgcol2="#aaf";
							}
							echo "<tr>";
							echo "<td style=\"width:250px;\" >".$ad." ".$soyad."</td>
							<td style=\"width:200px;\" bgcolor=\"$bgcol\"><b>$arsiv[konu]<b></td>
							<td bgcolor=\"$bgcol2\">&nbsp;</td>
							<td align=\"right\" style=\"width:300px;\" bgcolor=\"$bgcol2\">$arsiv[icerik]</td>";
							echo "</tr>";
							$sayac++;
							}
						}
						echo "</table>";
					}
					?>
				</th>
			</tr>
			<tr>
				<td style="width:150px;"><b><a href="index.php?num=2">Gelen Mesajlar
				<?php
				if($_SESSION["msgSayisi"]>0)
					echo "(".$_SESSION["msgSayisi"].")"; 
				?>
				</a></b></td>
			</tr>
			<tr>
				<td style="width:150px;"><b><a href="index.php?num=3">Gönderilenen Mesajlar</a></b></td>
			</tr>
			<tr>
				<td style="width:150px;"><b><a href="index.php?num=4">Arşiv</a></b></td>
			</tr>
		</table>
    </div>
	</div>
</html>