//en este archivo programamos las funciones de la interaccion con el menu lateral
// este archivo se cargara en menu.txt al comienzo
jQuery(document).ready(function() {
	var subFac = true; //variable de control para boton facturacion, abre y cierra el sub menu
	var url = window.location + ""; //captura la url local

	$("#id_fac").click(function () {// esta accion muestra y oculta el sub menu de facturacion
		if (subFac) {
			$('.desplegable').css("display","block");
			subFac = false;
		} else {
			$('.desplegable').css("display","none");
			subFac = true;
		}
	});
	$("#id_home").click(function(){
		if (url.indexOf("index") == -1) {
			window.location.href = "index.html";
		}
	});
	$("#id_cfac").click(function(){
		if (url.indexOf("crear_factura") == -1) {
			window.location.href = "crear_factura.php";
		}
	});
	$("#id_hfac").click(function(){
		if (url.indexOf("historial") == -1) {
			window.location.href = "historial_facturas.php";
		}
	});
	$("#id_inv").click(function(){
		if (url.indexOf("inv") == -1) {
			window.location.href = "inventario.php";
		}
	});
	$("#id_cata").click(function(){
		if (url.indexOf("catalogo.php") == -1) {
			window.location.href = "catalogo.php";
		}
	});
	$("#id_res").click(function(){
		if (url.indexOf("resultados.php") == -1) {
			window.location.href = "resultados.php";
		}
	});
	$("#id_cli").click(function(){
		if (url.indexOf("cliente") == -1) {
			window.location.href = "cliente.php";
		}
	});
	$("#id_admin").click(function(){
		if (url.indexOf("administracion.php") == -1) {
			window.location.href = "administracion.php";
		}
	});
});