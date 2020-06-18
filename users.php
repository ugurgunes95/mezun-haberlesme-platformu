<html>
<?php
	session_start();
	ob_start();
	
	include("baglanti.php");
?>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>All Template Needs</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/component.css">
    <link rel="stylesheet" href="css/custom-styles.css">
    <link rel="stylesheet" href="css/font-awesome.css">
	
     
	 <link rel="stylesheet" href="css/demo.css">
    <link rel="stylesheet" href="css/font-awesome-ie7.css">

</head>
<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="container">
      <div class="featured-block">
        <!-- Example row of columns -->
        <div class="row">
		<?php
			$SQL_users="SELECt * FROM users WHERE id<>'$_SESSION[kullanici]';";
			$sorgu_users=mysql_query($SQL_users,$baglanti);
			while($sonuc_users=mysql_fetch_array($sorgu_users))
			{
				echo "<div class=\"col-md-3\">";
				echo "<div class=\"block\">";
				echo "<div class=\"thumbnail\">";
					echo "<img src=\"$sonuc_users[pp]\" style=\"height:150px;width:100px;\" class=\"img-responsive\">";
					echo "<div class=\"caption\">";
					echo "<h1>".$sonuc_users[ad]." ".$sonuc_users[soyad]."</h1>";
					echo "<a class=\"btn\" href=\"index.php?msgSecilen=$sonuc_users[id]\">Mesaj Gönder</a>";
				  echo "</div>";
				  echo "</div>";
				echo"</div>";
				echo "</div>";
			}
				ob_end_flush();
		?>
          </div>
        </div>
	</div>
</html>