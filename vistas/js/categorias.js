/*========================================
=            EDITAR CATEGORIA            =
========================================*/
$(".btnEditarCategoria").click(function(){
		
	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		url:"ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			// console.log("respuesta", respuesta);
			
			$("#categoriaE").val(respuesta["categoria"]);
			$("#idCategoria").val(respuesta["id"]);

		}

	});
	
})

/*========================================
=          ELIMINAR CATEGORIA            =
========================================*/
$(".btnEliminarCategoria").click(function(){
		
	var idCategoria = $(this).attr("idCategoria");

	swal({

		title:'¿Está seguro de eliminar la categoría?',
		text: "¡Si no lo está puede cancela la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: "Cancelar",
		confirmButtonText: 'Si, borrar!'
	}).then((result) => {
	  if (result.value) {
	    
	  		window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;

	  }
	})	
	
})








