/*======================================
=            EDITAR CLIENTE            =
======================================*/
$(".btnEditarCliente").click(function() {
	
	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({

		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){			
			// console.log("respuesta", respuesta);

			$("#idCliente").val(respuesta["id"]);
			$("#clienteE").val(respuesta["nombre"]);
			$("#documentoE").val(respuesta["documento"]);
			$("#emailE").val(respuesta["email"]);
			$("#telefonoE").val(respuesta["telefono"]);
			$("#direccionE").val(respuesta["direccion"]);
			$("#fechaNacimientoE").val(respuesta["fecha_nacimiento"]);

		}

	})

})

/*========================================
=            ELIMINAR CLIENTE            =
========================================*/
$(".btnEliminarCliente").click(function(){

  var idCliente = $(this).attr("idCliente");
  // console.log("idCliente", idCliente);

  swal({
    title: '¿Está seguro de borrar el cliente?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cliente!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=clientes&idCliente="+idCliente;

    }

  })

})
