console.log("Arrancado Server de Node");
var basededatos={
	usuario:"miguel",
	clave:"sebas"
};
var express=require("express");
var parsero=require("body-parser");
var web = express();
web.use(parsero.urlencoded({extended:true}));

var server;

server=web.listen(8080, function(){
	console.log("Servidor Arrancado :D");
} );

/*web.get("/test", function(req, res){
	res.send("Buen trabajo estas corriendo un servidor web con node.js y tu avión es "+req.query.avion+" y tu edad es "+req.query.edad+" años");
});*/
web.get("/", function(req, res){
	res.sendfile("Formulario.html");
})

web.post("/entrar", function(req, res){
	if(req.body.usuario==basededatos.usuario&&req.body.clave==basededatos.clave)
	{
		res.send("Bienvenido al area exclusiva de usuarios");
	}
	else
	{
		res.send("Lo sentimos, hay algun problema con tu usaurio o tu clave, rectificalos y vuelve a intentarlo!!!");
	}
	res.send("Entraste al formulario");
});