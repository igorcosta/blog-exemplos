;(function(){
    
	var Classe = window.Classe = {};

	var fator = function () {};


    var inherits = function (parent, protoProps, staticProps) {
        var child;
        if (protoProps && protoProps.hasOwnProperty('constructor')) {
            child = protoProps.constructor;
        } else {
            child = function () { return parent.apply(this, arguments); };
        }
        // vindo do underscoreJS
        _.extend(child, parent);

        //Prototype é quem vai fazer valer a pena
        fator.prototype = parent.prototype;
        child.prototype = new fator();

        if (protoProps) _.extend(child.prototype, protoProps);
        if (staticProps) _.extend(child, staticProps);

        child.prototype.constructor = child;
        child.__super__ = parent.prototype;

        return child;
    };
    function ExtendsEls(protoProps, staticProps) {
        var child = inherits(this, protoProps, staticProps);
        child.extend = ExtendsEls;
        return child;
    }
    Classe.Base = function () {};
    Classe.Base.extends = ExtendsEls;
})();