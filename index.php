<?php
include 'functions.php';
// if (empty($_SESSION['login']))
//   header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" href="logo.jpg" />

	<title>SPK Metode WP </title>
	<link href="assets/css/paper-bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/general.css" rel="stylesheet" />
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-style: italic;
}
-->
    </style>
</head>
<body>
    <header class="container bg-primary text-white">
        <div class="row">
      <div class="col-lg-2 col-md-2">      </div>
      <div class="col-lg-1 col-md-1 text-white">
       <h6><img class="img-circle" src="logo.jpg" width="100px;"></h6>
     </div>
     <div class="col-lg-7 col-md-7 text-center">
       <h3><strong>SMKS PPM SHADR EL-ISLAM ASAHAN</strong></h3>
       <p align="center"><em>Jl. Besar Danau Sijabut, Danau Sijabut, Kec. Air Batu, Kab. Asahan Prov. Sumatera Utara, Telp.081361755610 Email : </em><a href="smksppmshadr_asahan@gmail.com" class="style1">smksppmshadr_asahan@gmail.com</a></p>
       <h6>&nbsp;</h6>
       <hr>
     </div>
     <div class="col-lg-2 col-mmd-2">     </div>
        </div>
    </header>
   
    
	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>				</button>
				<a class="navbar-brand" href="?">Home</a>			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">

					<li class="dropdown <?= is_hidden('kriteria') ?>">
						<a href="?m=kriteria" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-th-large"></span> Kriteria <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="?m=kriteria"><span class="glyphicon glyphicon-th-large"></span> Kriteria</a></li>
							<li><a href="?m=crips"><span class="glyphicon glyphicon-star"></span> Nilai Bobot Kriteria</a></li>
						</ul>
					</li>
					<li class="<?= is_hidden('alternatif') ?>"><a href="?m=alternatif"><span class="glyphicon glyphicon-user"></span> Alternatif</a></li>

					<li class="<?= is_hidden('nilai') ?>"><a href="?m=nilai"><span class="glyphicon glyphicon-calendar"></span> Penilaian</a></li>
					<li class="<?= is_hidden('responden') ?>"><a href="?m=responden"><span class="glyphicon glyphicon-calendar"></span> Data Responden</a></li>
					<li class="<?= is_hidden('wp') ?>"><a href="?m=wp"><span class="glyphicon glyphicon-stats"></span> Perhitungan Metode WP</a></li>
					<li class="<?= is_hidden('hitung') ?>"><a href="?m=hitung"><span class="glyphicon glyphicon-user"></span> Hasil Perhitungan</a></li>
					<li class="<?= is_hidden('password') ?>"><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
					<li class="<?= is_hidden('logout') ?>"><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout (<?= $_SESSION['level'] ?>)</a></li>

				
                	<li class="<?= is_hidden('daftar') ?>"><a href="?m=daftar"><span class="glyphicon glyphicon-user"></span> Daftar Responden</a></li>					
					<li class="<?= is_hidden('login') ?>"><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container">
		<?php
		if (file_exists($mod . '.php'))
			include $mod . '.php';
		else
			include 'home.php';
		?>
	</div>
	<footer class="footer bg-primary">
		<div class="container">
			<p><marquee>
			Copyright &copy; <?= date('Y') ?> SMKS PPM SHADR EL-ISLAM ASAHAN<em class="pull-right"> </em></p> </marquee>
		</div>
	</footer>
	<script type="text/javascript">
		$('.form-control').attr('autocomplete', 'off');
	</script>
</body>
</html>