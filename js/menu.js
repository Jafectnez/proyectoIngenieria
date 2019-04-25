jQuery(document).ready(function() {
    var dir_menu = "js/menu.txt"; //direccion donde se encuentra el menu
	$.ajax({
		url : dir_menu,
		dataType: "text",
		success : function (data) 
		{
			$("#barraNav").html(data);
			$("#chk").on("click", function(){
				$("#barraNav .profile-sidebar .profile-usermenu").toggle();
			});

			regexp = {
				facturacion: /.Factura/,
				inventario: /.Inventario/,
				emision: /.Emisión de Resultados/,
				catalogo: /.Catálogo/,
				cliente: /.Clientes/,
				administracion: /.Administración/
			}
			
			$(`#li-facturacion`).removeClass("active");
			for(var i in regexp){
				if(regexp[i].exec(document.title)){
					$(`#li-${i}`).addClass("active");
					break;
				}
			}
		}
	});
});

function cerrarSesion() {
	$.ajax({
		url:"ajax/acciones-sesion.php",
		method: "POST",
		data: {
			"accion": "cerrar-sesion"
		},
		success: function(respuesta){
			window.location="login.php";
		}
	});
}

