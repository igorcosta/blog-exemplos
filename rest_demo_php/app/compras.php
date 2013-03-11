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
					<li><a href="clientes.php">Clientes</a></li>
					<li  class="active"><a href="compras.php">Compras</a></li>
					<li><a href="config.php">Configurações</a></li>
				</ul>				
			</div>
		</div>
	</div>
</div>
<div class="container">
		<div class="row">
				<div class="span12" >
					<h4>Histórico de vendas</h4>
				</div>
				<div class="span12">
					<a href="#comprasModal" role="button" class="btn btn-primary" data-toggle="modal">Registrar nova venda</a>
				</div>
				<div class="pull-right">
					<h2 id="totalCompras">Total 00</h2>
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
				      <th>Valor</th>
				      <th>Data da compra</th>
				      <th>Ações</th>
				    </tr>
				  </thead>
				  <tbody id="compras">
				    <tr>
				      <td>01</td>
				      <td>Igor Costa</td>
				      <td>R$400,00</td>
				      <td>20/11/2012</td>
				      <td>
				      	<div class="btn"><i class="icon-edit"></i></div>
				      	<div class="btn btn-danger"><i class="icon-remove icon-white"></i></div>				      	
				      </td>
				    </tr>
				  </tbody>
				</table>
			</div>
		</div>
</div>

 
<!-- Modal Compras -->
<div id="comprasModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ComprasModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="ComprasModalLabel">Nova compra</h3>
  </div>
  <div class="modal-body">
    	<form class="form" id="form-compras">
    		<fieldset>
		   		<div class="control-group">
		  			<label class="control-label" for="multiSelect">Selecione o cliente</label>
		  			<div class="controls">
		  				<select id="ClienteDropbox">
		  					<option value="0">-------</option>
		  				</select>
		  			</div>
		  		</div>   			
    			<div class="control-group">
    				<label class="control-label" for="valorCompraInput">Valor da compra</label>
    				<div class="controls">
    					<input type="text" pattern="[0-9.]+" class="input-xlarge" name="valor_compra" id="valorCompraInput">
    					<p class="help-block">Digite o valor da compra ex: 50,54</p>
    				</div>
    			</div>
    		</fieldset>
    	</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-primary" id="RegistrarCompraBtn">Registrar</button>
  </div>
</div>

<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/2.3.1/css/bootstrap-responsive.min.css" />
<link type="text/css" rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/2.3.1/css/bootstrap.min.css" />>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/2.3.1/js/bootstrap.min.js"></script>
</body>
</html>