// Classe extendida da classe pai Classe
var Carro = Classe.Base.extends({
	aceleracao : 0,
	buzinar: function (){
		console.log('bit bit, sai do meio!');
	}
});

// Carro de corrida extende Carro

var CarroCorrida = Carro.extends({
	constructor : function (name){
		CarroCorrida.__super__.constructor.call(this,name);
	},
	acelerar: function (){
		var acc = this.aceleracao > 300 ? this.aceleracao=Math.round(300 - Math.random()*300) : this.aceleracao+=10;
		$('body').html('<p>'+ acc +' km/h</p>');
		console.log(this.aceleracao + ' km/h');
	}

});


// Ferrari é um objeto 
var ferrari = new CarroCorrida();
ferrari.buzinar();

// Testar a aceleracao
window.setInterval(function(){ferrari.acelerar()},100);