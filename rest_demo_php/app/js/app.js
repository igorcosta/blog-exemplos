$(document).ready(function(e){





var url = window.location.pathname;
var pagina = url.substring(url.lastIndexOf('/')+1);

// Listar clientes

if(pagina == 'clientes.php'){
		api.getClientes();
}
// Listar compras
if(pagina == 'compras.php'){

		api.getComprasHistorico();
		api.showClientes();
}


$("#NovoClienteBtn").on('click',function(e){
	var novoCliente = $("#clienteInput").val();
	
	
	$.ajax({
	  url: api.REST_API_URL +'/cliente',
	  type: 'PUT',
	  dataType: 'json',
	  data: {nome: novoCliente},
	  complete: function(xhr, textStatus) {
	   $("#clienteModal").modal('hide');
	   api.getClientes();
	   api.alerta('ok','Cliente adicionado com sucesso!');
	  },
	  success: function(data, textStatus, xhr) {
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //called when there is an error
	  }
	});
	
	e.preventDefault();

});

$("#RegistrarCompraBtn").on('click',function(e){
	e.preventDefault();
	var cliente = $("#ClienteDropbox").val();
	var valor 	= $("#valorCompraInput").val();
	$.ajax({
	  url: api.REST_API_URL + '/compra',
	  type: 'PUT',
	  dataType: 'json',
	  data: {cliente_id:cliente,valor:valor},
	  complete: function(xhr, textStatus) {
	    //called when complete
	  },
	  success: function(data, textStatus, xhr) {
	     $("#comprasModal").modal('hide');
	   	 api.getComprasHistorico();
	   	 api.alerta('ok','Compra registrada');
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //called when there is an error
	  }
	});
	
});
$("#backupBtn").on('click',function(e){

	$.ajax({
	  url: api.REST_API_URL + '/backup',
	  type: 'GET',
	  dataType: 'html',
	  complete: function(xhr, textStatus) {
	    //called when complete
	  },
	  success: function(data, textStatus, xhr) {
	   	$("#backuplink").append(data + '</br>');
	  },
	  error: function(xhr, textStatus, errorThrown) {
	    //called when there is an error
	  }
	});
	
});

});