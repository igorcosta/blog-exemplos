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
			<a class="brand" href="./">RESTful PHP</a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="active"><a href="clientes.php">Clientes</a></li>
					<li><a href="compras.php">Compras</a></li>
					<li><a href="config.php">Configurações</a></li>
				</ul>				
			</div>
		</div>
	</div>
</div>

<div class="container">
		<div class="row">
				<div class="span12" >
					<h4>Meus clientes</h4>
				</div>
				<div class="span12">
					<a href="#clienteModal" role="button" class="btn btn-primary" data-toggle="modal">Adicionar novo cliente</a>
				</div>
				<div class="pull-right">
					<h2 id="totalClientes">Total 00</h2>
				</div>
		</div>
		<div class="row">
			<div class="span12" id="alert_status">
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<table class="table">
				  <thead>
				    <tr>
				      <th>Id</th>
				      <th>Cliente</th>
				      <th>Ações</th>
				    </tr>
				  </thead>
				  <tbody id="clientes">

				  </tbody>
				</table>
			</div>
		</div>
</div>

<!-- Modal Cliente -->
<div id="clienteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ClienteModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="ClienteModalLabel">Novo cliente</h3>
  </div>
  <div class="modal-body">
    	<form class="form-horizontal" id="form-cliente">
    		<fieldset>
    			<div class="control-group">
    				<label class="control-label" for="clienteInput">Cliente</label>
    				<div class="controls">
    					<input type="text" class="input-xlarge" name="nome" id="clienteInput">
    					<p class="help-block">Digite o nome do cliente para cadastrar</p>
    				</div>
    			</div>
    		</fieldset>
    	</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-primary" id="NovoClienteBtn">Criar</button>
  </div>
</div>
<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/2.3.1/css/bootstrap-responsive.min.css" />
<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/2.3.1/css/bootstrap.min.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/2.3.1/js/bootstrap.min.js"></script>
</body>
</html>