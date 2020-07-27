/*=============================================================
=            CARGAR LA TABLA DINAMICA DE PRODUCTOS            =
=============================================================*/
// $.ajax({
// 	url: "ajax/datatable-productos.ajax.php",
// 	success: function(respuesta){

// 		console.log("respuesta", respuesta);


// 	}

// })

var perfilOculto = $("#perfilOculto").val();
console.log("perfilOculto", perfilOculto);

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	        "sFirst":    "Primero",
	        "sLast":     "Último",
	        "sNext":     "Siguiente",
	        "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }
	}
})


/*======================================================================
=            CAPTURANDO LA CATEGORIA PARA ASIGNAR UN CODIGO            =
======================================================================*/
// $("#categoriaN").change(function() {
	
// 	var idCategoria = $(this).val();
// 	var datos = new FormData();

// 	datos.append("idCategoria", idCategoria);

// 	$.ajax({
// 			url: "ajax/productos.ajax.php",
// 			method: "POST",
// 			data: datos,
// 			cache: false,
// 			contentType: false,
// 			processData: false,
// 			dataType: "json",
// 			success:function(respuesta){
// 				// console.log("respuesta", respuesta);

// 				if (!respuesta) {

// 					var nuevoCodigo = idCategoria+"01";
// 					$("#codigoN").val(nuevoCodigo);

// 				}else{

// 					var nuevoCodigo = new Number(respuesta["codigo"]) + 1;
// 					$("#codigoN").val(nuevoCodigo);

// 				}

// 			}

// 		})


// })

/*=================================================
=            AGREGANDO PRECIO DE VENTA            =
=================================================*/
$("#precioCompraN, #precioCompraE").change(function() {

	if ($(".porcentaje").prop("checked")) {

		var valorPorcentaje = $(".nuevoPorcentaje").val();

		var porcentaje =Number(($("#precioCompraN").val()*valorPorcentaje/100))+Number($("#precioCompraN").val());

		var editarPorcentaje =Number(($("#precioCompraE").val()*valorPorcentaje/100))+Number($("#precioCompraE").val());
		// console.log("porcentaje", porcentaje);
		
		$("#precioVentaN").val(porcentaje);
		$("#precioVentaN").prop("readonly",true);

		$("#precioVentaE").val(editarPorcentaje);
		$("#precioVentaE").prop("readonly",true);

	}

})

/*============================================
=            CAMBIO DE PORCENTAJE            =
============================================*/
$(".nuevoPorcentaje").change(function() {
	
	if ($(".porcentaje").prop("checked")) {

		var valorPorcentaje = $(this).val();

		var porcentaje =Number(($("#precioCompraN").val()*valorPorcentaje/100))+Number($("#precioCompraN").val());

		var editarPorcentaje =Number(($("#precioCompraE").val()*valorPorcentaje/100))+Number($("#precioCompraE").val());
		// console.log("porcentaje", porcentaje);
		
		$("#precioVentaN").val(porcentaje);
		$("#precioVentaN").prop("readonly",true);

		$("#precioVentaE").val(editarPorcentaje);
		$("#precioVentaE").prop("readonly",true);

	}

})

$(".porcentaje").on("ifUnchecked", function(){

	$("#precioVentaN").prop("readonly",false);
	$("#precioVentaE").prop("readonly",false);

})

$(".porcentaje").on("ifChecked", function(){

	$("#precioVentaN").prop("readonly",true);
	$("#precioVentaE").prop("readonly",true);

})

/*=============================================
SUBIENDO LA IMAGEN DEL PRODUCTO
=============================================*/
$(".imagenN").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".imagenN").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".imagenN").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function() {
	
	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({
			url: "ajax/productos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(respuesta){
				// console.log("respuesta", respuesta);

				var datosCategoria = new FormData();
				datos.append("idCategoria", respuesta["id_categoria"]);


				$.ajax({
						url: "ajax/categorias.ajax.php",
						method: "POST",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success:function(respuesta){
							// console.log("respuesta", respuesta);

							$("#categoriaE").val(respuesta["id"]);
							$("#categoriaE").html(respuesta["categoria"]);

						}

					})

				$("#codigoE").val(respuesta["codigo"]);
				$("#descripcionE").val(respuesta["descripcion"]);
				$("#stockE").val(respuesta["stock"]);
				$("#precioCompraE").val(respuesta["precio_compra"]);
				$("#precioVentaE").val(respuesta["precio_venta"]);

				if (respuesta["imagen"] != "") {

					$("#imagenActual").val(respuesta["imagen"]);
					$(".previsualizar").attr("src", respuesta["imagen"]);

				}

				
			}

		})

})

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function() {
	
	var idProducto = $(this).attr("idProducto");
  	var codigo = $(this).attr("codigo");	
  	var imagen = $(this).attr("imagen");

  	swal({

  		title: '¿Está seguro de eliminar el producto',
  		text: "¡Si no lo está puede cancelar la accíón!",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    cancelButtonText: 'Cancelar',
	    confirmButtonText: 'Si, borrar producto!'
	  }).then(function(result){

	    if(result.value){

	      window.location = "index.php?ruta=productos&idProducto="+idProducto+"&codigo="+codigo+"&imagen="+imagen;

	    }

	  })


})









