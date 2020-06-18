<?php
	session_start();
	ob_start();
	include("baglanti.php");
	
	echo "<center>";
		$SQL_profile="SELECT * FROM users WHERE id='$_SESSION[kullanici]';";
		$sorgu_profile=mysql_query($SQL_profile,$baglanti);
		echo "<form name=\"guncelle\" action=\"update.php\" method=\"POST\" enctype=\"multipart/form-data\">";
		echo "<table border=\"0\">";
		while($sonuc_profile=mysql_fetch_array($sorgu_profile))
		{
			echo "<tr>";
				echo "<td colspan=\"2\" align=\"center\"><img src=\"$sonuc_profile[pp]\" style=\"height:200px;width:170px;\" class=\"img-responsive\"></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=\"right\">Ad:</td>";
				echo "<td><input type=\"text\" value=\"".ucfirst($sonuc_profile[ad])."\" name=\"newName\" disabled></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=\"right\">Soyad:</td>";
				echo "<td><input type=\"text\" value=\"".ucfirst($sonuc_profile[soyad])."\" name=\"newLastname\" disabled></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=\"right\">Eposta:</td>";
				echo "<td><input type=\"text\" value=\"$sonuc_profile[eposta]\" name=\"newMail\" name=\"newMail\" ></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=\"right\">Şifre:</td>";
				echo "<td><input type=\"text\" value=\"$sonuc_profile[sifre]\" name=\"newPass\"></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=\"right\">Yeni resim:</td>";
				echo "<td><input type=\"file\" name=\"newPP\"</td>";
			echo "</tr>";
		}
		echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" class=\"btn btn-danger\" value=\"Güncelle\"></td></tr>";
		echo "</table>";
		echo "</form>";
	echo "</center>";
		ob_end_flush();
?>