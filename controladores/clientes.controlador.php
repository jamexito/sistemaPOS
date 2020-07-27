<?php 

/**
 * ControladorClientes
 */
class ControladorClientes
{

	/*=====================================
	=            CREAR CLIENTE            =
	=====================================*/
	public function ctrCrearCliente()
	{
		
		if (isset($_POST["clienteN"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteN"]) &&
				preg_match('/^[0-9]+$/', $_POST["documentoN"]) &&
			    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailN"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["telefonoN"]) &&
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["direccionN"]) ) {

				$tabla = "clientes";

				$datos = array("nombre" => $_POST["clienteN"],
							   "documento"       => $_POST["documentoN"],
							   "email"  => $_POST["emailN"],
							   "telefono"        => $_POST["telefonoN"],
							   "direccion"=> $_POST["direccionN"],
							   "fecha_nacimiento" => $_POST["fechaNacimientoN"]);

				$resultado = ModeloClientes::mdlCrearCliente($tabla, $datos);

				if ($resultado == "ok") {
					
					echo '<script>

							swal({
								type: "success",
								title: "¡El cliente ha sido creado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "clientes";

								}

							});					

						</script>';

				}

			}else{

				echo'<script>

						swal({

							type: "error",
							title: "¡El cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){

							if(result.value){
							
								window.location = "clientes";

							}

						});					

					</script>';

			}

		}

	}

	/*========================================
	=            MOSTRAR CLIENTES            =
	========================================*/
	static public function ctrMostrarClientes($item, $valor){
		
		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*======================================
	=            EDITAR CLIENTE            =
	======================================*/
	public function ctrEditarCliente(){
		
		if (isset($_POST["clienteE"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["clienteE"]) &&
				preg_match('/^[0-9]+$/', $_POST["documentoE"]) &&
			    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailE"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["telefonoE"]) &&
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["direccionE"]) ) {

				$tabla = "clientes";

				$datos = array("id" => $_POST["idCliente"],
							   "nombre" => $_POST["clienteE"],
							   "documento" => $_POST["documentoE"],
							   "email"  => $_POST["emailE"],
							   "telefono" => $_POST["telefonoE"],
							   "direccion"=> $_POST["direccionE"],
							   "fecha_nacimiento" => $_POST["fechaNacimientoE"]);

				$resultado = ModeloClientes::mdlEditrarCliente($tabla, $datos);

				if ($resultado == "ok") {
					
					echo '<script>

							swal({
								type: "success",
								title: "¡El cliente ha sido actualizado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "clientes";

								}

							});					

						</script>';

				}else{


					echo 'error';
				}

			}else{

				echo'<script>

						swal({

							type: "error",
							title: "¡El cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){

							if(result.value){
							
								window.location = "clientes";

							}

						});					

					</script>';

			}

		}

	}

	/*========================================
	=            ELIMINAR CLIENTE            =
	========================================*/
	public function ctrEliminarCliente(){
		
		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido eliminado exitosamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}	
	

}

