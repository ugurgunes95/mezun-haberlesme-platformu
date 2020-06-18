<?php
	session_start();
	ob_start();
	include("baglanti.php");
	
	
	$_SESSION["msgSayisi"]=0;
	$SQL_gelenler2="SELECT * FROM messages WHERE alici_id='$_SESSION[kullanici]';";
	$sorgu_gelenler2=mysql_query($SQL_gelenler2,$baglanti);
	while($gelenler=mysql_fetch_array($sorgu_gelenler2))
	{
		if($gelenler[durum]==0)
			$_SESSION["msgSayisi"]++;
	}
	
	$menuId=$_GET[menu];
	if($menuId=='')
	{
		$menuId=1;
	}
	$_SESSION[message]=$_GET[num];
	$_SESSION[secilenmsg]=$_GET[msgSecilen];
	
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<script language="JavaScript">
		function gooo(aa)
		{
			window.location = "index.php?menu="+aa.value;
		}
		function degistir()
		{
			var ifade=document.kisisel.user.value;
			document.kisisel.user.value=ifade.toLowerCase();
		}
		function degistir2()
		{
			var ifade=document.kayit.userName.value;
            var ifade2=document.kayit.userLastname.value;
            var ifade3=document.kayit.userEmail.value;
			document.kayit.userName.value=ifade.toLowerCase();
            document.kayit.userLastname.value=ifade2.toLowerCase();
            document.kayit.userEmail.value=ifade3.toLowerCase();
		}
		function kontrol()
		{
			var ifade=document.kisisel.user.value;
			var ifadeKontrol=ifade.split("@");
			//alert(ifadeKontrol.length);
			if(ifadeKontrol.length!=2)
			{
				alert("Geçersiz e-posta adresi girdiniz!");
				document.kisisel.reset();
			}
			else
			{
				document.kisisel.submit();
			}
		}
		function kontrol2()
		{
			var ifade=document.kayit.userEmail.value;
			var ifadeKontrol=ifade.split("@");
			if(ifadeKontrol.length!=2)
			{
				alert("Geçersiz e-posta adresi girdiniz!");
				document.kayit.reset();
			}
			else
			{
				document.kayit.submit();
			}
		}
	</script>
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

      <script src="js/jquery.mobilemenu.js"></script>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script>
    $(document).ready(function(){
        $('.menu').mobileMenu();
    });
  </script>
<style type="text/css">
		#giris
		{
			position:fixed;
			border:2px solid #aaf;
			border-radius:30px;
			box-shadow:0px 0px 5px 5px #acc;
			width:270px;
			height:100px;
			background-color:#eac;
			z-index:9999;
			left:50px;
			top:100px;
			text-align:center;
		}
		#katman
		{
			position:fixed;
			border:2px solid #aaf;
			border-radius:30px;
			box-shadow:0px 0px 5px 5px #acc;
			width:400px;
			height:350px;
			background-color:#eff;
			z-index:9999;
            left:570px;
			top:190px;
			text-align:center;
		}
		.input
		{
			box-shadow:0px 0px 2px 2px;
			border-radius:10px;
			background-color:Turquoise;
			padding:5px 3px;
			margin:4px;
		}
</style>
</head>

  <body>
    <div class="header-wrapper">
      <div class="site-name">
        <h1>Mezunlar</h1>
        <h2></h2>
      </div>
	  
	<?php
	
	if($_SESSION["kullanici"]<1)
	{
	?>
	<div>
		<center>
		<form name="kisisel" action="login.php" method="POST">
		<table border="0" cellspacing="0">
			<tr>
				<td><input type="text" class="input" name="user" placeholder="E-posta" onKeyUp="degistir()"></td>
				<td><input type="password" class="input" name="pass" placeholder="Şifre"></td>
				<td><input type="button" class="btn btn-info" value="GİRİŞ" onClick="kontrol()"></td>
			</tr>
		</table>
		</form>
    <div id="katman">
        <center>
		<form name="kayit" action="register.php" method="POST" enctype="multipart/form-data">
		<table border="0" cellspacing="0">
			<tr>
                <td colspan="2"><center><strong>Kayıt Ol</strong></center><hr></td>
            </tr>
            <tr>
				<td align="center"><input type="text" class="input" name="userName" placeholder="Adınız" onKeyUp="degistir2()"></td>
            </tr>
            <tr>
				<td align="center"><input type="text" class="input" name="userLastname" placeholder="Soyadınız" onKeyUp="degistir2()"></td>
            </tr>
            <tr>
				<td align="center"><input type="text" class="input" name="userEmail" placeholder="E-posta adresiniz" onKeyUp="degistir2()"></td>
            </tr>
            <tr>
                <td align="center"><input type="password" class="input" name="userPass" placeholder="Şifre"></td>
            </tr>
            <tr>
				<td><input type="file" class="input" name="userPicture" style="width:190px;"></td>
            </tr>
				<td colspan="2"><center><input type="button" class="btn btn-success" value="KAYDOL" onClick="kontrol2()"></td></center>
			</tr>
		</table>
		</form>
    </div>
	</div>
	<?php
	}
	if(1==1)
	{
		echo "<br>Hoşgeldin, <b>".ucfirst($_SESSION["ad"])." ".ucfirst($_SESSION["soyad"]);
		echo "</b></div>";
	}

	if($_SESSION["kullanici"]>0)
	{
	?>
    <div class="menu">
      <div class="navbar">
        <div class="container">
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
			<?php
				$SQL_menu="SELECT * FROM menuler;";
				$sorgu_menu=mysql_query($SQL_menu,$baglanti);
				while($menuler=mysql_fetch_array($sorgu_menu))
				{
					if($menuler[id]==3 && $_SESSION["msgSayisi"]>0)
						echo "<li><a href=\"index.php?menu=$menuler[id]\">$menuler[baslik]"."(".$_SESSION["msgSayisi"].")"."</a></li>";
					else
						echo "<li><a href=\"index.php?menu=$menuler[id]\">$menuler[baslik]</a></li>";
				}
			?>
            </ul>
          </div><!--/.navbar-collapse -->
        </div>
      </div>
      <div class="mini-menu">
            <label>
          <select class="selectnav" name="mId" onchange="javascript:gooo(this)">
		<?php
		$SQL_menu="SELECT * FROM menuler;";
		$sorgu_menu=mysql_query($SQL_menu,$baglanti);
		while($menuler=mysql_fetch_array($sorgu_menu))
		{
			if($menuler[id]==1)
				echo "<option value=\"$menuler[id]\" selected=\"\">$menuler[baslik]</option>";
			else if($menuler[id]==5)
				echo "<option value=\"$menuler[id]\">$menuler[baslik]</option>";
			else
				echo "<option value=\"$menuler[id]\">$menuler[baslik]</option>";
		}
		?>
          </select>
          </label>
          </div>
    </div>
	<?php
		if($menuId==1 && $_SESSION[message]=='' && $_SESSION[secilenmsg]=='')
			echo "<br><center><p>Mezunlar platformuna hoşgeldin, <b>".ucfirst($_SESSION["ad"])." ".ucfirst($_SESSION["soyad"]).".<b></p></center>";
		if($menuId==2)
			include("profile.php");
		if($menuId==3 || $_SESSION[message]>0 || $_SESSION[secilenmsg]>0 || isset($_POST['gndr']))
			include("messages.php");
		if($menuId==4)
			include("users.php");
		if($menuId==5)
			include("logout.php");
	}
	?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </body>
<?php
	ob_end_flush();
?>
</html>
