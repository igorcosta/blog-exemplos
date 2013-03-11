var api = {
	REST_API_URL : "http://localhost/temp/rest_demo",
	getClientes : function (){
	 	$.ajax({
		  url: this.REST_API_URL + '/clientes',
		  type: 'GET',
		  dataType: 'json',
		  complete: function(xhr, textStatus) {
		  },
		  success: function(data, textStatus, xhr) {
		  		  $("#clientes").empty();
		          $.each(data,function(index,value){
		          		var item = '<tr><td>'+value.id+'</td><td>'+value.nome+'</td><td>'+
					      	'<div class="btn" onClick="api.editCliente('+value.id+')"><i class="icon-edit"></i></div> '+
					      	'<div class="btn btn-danger" onClick="api.removeCliente('+value.id+')">'+
					      	'<i class="icon-remove icon-white"></i></div></td></tr>';
					    $("#clientes").append(item);
		          });
		          $("#totalClientes").html('Total '+data.length);
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }
		});
	 },
	 showClientes : function() {
	 	$.ajax({
		  url: this.REST_API_URL + '/clientes',
		  type: 'GET',
		  dataType: 'json',
		  complete: function(xhr, textStatus) {
		  },
		  success: function(data, textStatus, xhr) {
		          $.each(data,function(index,value){
		          		var item = '<option value="'+value.id+'">'+value.nome+'</option>';
					    $("#ClienteDropbox").append(item);
		          });
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    //called when there is an error
		  }
		});
	 },
	 getComprasHistorico : function (){
	 	$.ajax({
		  url: this.REST_API_URL + '/historico-compras',
		  type: 'GET',
		  dataType: 'json',
		  complete: function(xhr, textStatus) {
		  },
		  success: function(data, textStatus, xhr) {
		  		  $("#compras").empty();
		          $.each(data,function(index,value){
		          		moment.lang('pt-br');
		          		var realizada = moment(value.compra_realizada, "YYYYMMDD").fromNow();

		          		var item = '<tr><td>'+value.id+'</td><td>'+value.nome+'</td><td>'+value.valor+'</td>'+
		          		'<td>'+realizada+'</td>'+
		          		'<td><div class="btn" onClick="api.editCompra('+value.id+')"><i class="icon-edit"></i></div> '+
		          		'<div class="btn btn-danger" onClick="api.removeCompra('+value.id+')"><i class="icon-remove icon-white">'+
		          		'</i></div></td></tr>';
					    $("#compras").append(item);
		          });
		          $("#totalCompras").html('Total '+data.length);
		  },
		  error: function(xhr, textStatus, errorThrown) {
		   		api.alerta('error','Erro ao tentar executar ação, tente novamente.');
		  }
		});
	 },
	 editCliente : function (param){

	 	$("#clienteModal").modal();
	 	$("#clienteInput").val(param.nome);		
	 },
	 removeCliente : function (param){
	    $.ajax({
	 	  url: this.REST_API_URL+ '/cliente',
	 	  type: 'DELETE',
	 	  dataType: 'json',
	 	  data: {id: param},
	 	  complete: function(xhr, textStatus) {
	 	    
	 	  },
	 	  success: function(data, textStatus, xhr) {
	 	  		api.alerta('ok','Removido com sucesso!');
	 	   		api.getClientes();
	 	  },
	 	  error: function(xhr, textStatus, errorThrown) {
	 	    api.alerta('error','Erro ao tentar executar ação, tente novamente.');
	 	  }
	 	});
	 },
	 removeCompra: function (param){
	    $.ajax({
	 	  url: this.REST_API_URL+ '/compra',
	 	  type: 'DELETE',
	 	  dataType: 'json',
	 	  data: {id: param},
	 	  complete: function(xhr, textStatus) {
	 	    
	 	  },
	 	  success: function(data, textStatus, xhr) {
	 	  		api.alerta('ok','Compra removida!');
	 	   		api.getComprasHistorico();
	 	  },
	 	  error: function(xhr, textStatus, errorThrown) {
	 	    api.alerta('error','Erro ao tentar executar ação, tente novamente.');
	 	  }
	 	});
	 },
	 alerta : function(tipo,msg){
	 		switch(tipo)
	 		{
 				case 'ok':
 					 $("#alert_status").html('<div class="alert alert-success">'+
   						   '<button type="button" class="close" data-dismiss="alert">×</button>'+
   						   '<strong>Sucesso. </strong> '+msg+'</div>');
 			    break;
 			    case 'error':
 			    	 $("#alert_status").html('<div class="alert alert-error">'+
   						   '<button type="button" class="close" data-dismiss="alert">×</button>'+
   						   '<strong>Falha. </strong> '+msg+'</div>');
 			    break;
	 		}
	 }
}