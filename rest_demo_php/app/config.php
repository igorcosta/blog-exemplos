<!doctype html>
<html>
<head>
<?php require_once('requires/js.php'); ?>
<meta charset="utf-8">
<title>REST App</title>
</head>

<body>
<div class="navbar">
	<div class="navbar-inner">
		<div class="container" style="width: auto;">
			<a class="brand" href="#">RESTful PHP</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li><a href="clientes.php">Clientes</a></li>
					<li><a href="compras.php">Compras</a></li>
					<li class="active"><a href="config.php">Configurações</a></li>
				</ul>				
			</div>
		</div>
	</div>
</div>

<div class="container">
		<div class="row">
				<div class="span12" >
					<h4>Configurações do sistema</h4>
				</div>

		</div>
		<div class="row">
				<div class="span12">
					<a href="#" id="backupBtn" class="btn btn-inverse">Backup do banco de dados</a>
				</div>
		</div>
		<div class="row">
				<div class="span12" id="backuplink"> </div>
		</div>
</div>


<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/2.3.1/css/bootstrap-responsive.min.css" />
<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/2.3.1/css/bootstrap.min.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/2.3.1/js/bootstrap.min.js"></script>
</body>
</html>