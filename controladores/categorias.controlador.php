<?php 

/**
 * ControladorCategorias()
 * ctrCrearCategoria()
 * ControladorCategorias
 * ctrMostrarCategorias($item, $valor)
 * ctrEditarCategoria()
 * ctrBorrarCategoria()
 */
class ControladorCategorias
{

	/*=======================================
	=            CREAR CATEGORIA            =
	=======================================*/
	public function ctrCrearCategoria(){

		if (isset($_POST["categoriaN"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["categoriaN"])) {
				
				$tabla = "categorias";

				$datos = $_POST["categoriaN"];

				$respuesta = ModeloCategorias::mdlCrearCategoria($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

							swal({

								type: "success",
								title: "¡La categoría ha sido creada correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "categorias";

								}

							});
					

						</script>';

				}

			}else{

				echo '<script>

						swal({

							type: "error",
							title: "¡La categoría no puede ir vacia o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){

							if(result.value){
							
								window.location = "categorias";

							}

						});
					

					</script>';

			}

		}

	}

	/*=========================================
	=            MOSTRAR CATEGORIA            =
	=========================================*/
	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;

	}

	/*=========================================
	=            EDITAR  CATEGORIA            =
	=========================================*/
	public function ctrEditarCategoria(){

		if (isset($_POST["categoriaE"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["categoriaE"])) {
				
				$tabla = "categorias";

				$datos = array("id" =>$_POST["idCategoria"], "categoria" =>$_POST["categoriaE"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

							swal({
							  title: "¡La categoría ha sido actualizada correctamente!",
							  type: "success",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							}).then((result) => {
							  	if(result.value){
								
									window.location = "categorias";

								}
							});
					

						</script>';

				}

			}else{

				echo '<script>

						swal({

							type: "error",
							title: "¡La categoría no puede ir vacia o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){

							if(result.value){
							
								window.location = "categorias";

							}

						});
					

					</script>';

			}

		}

	}

	/*==========================================
	=            BORRAR CATEGORIA            =
	==========================================*/
	public function ctrBorrarCategoria(){

		if (isset($_GET["idCategoria"])) {
			
			$tabla = "categorias";

			$datos = $_GET["idCategoria"];

			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if ($respuesta == "ok") {
					
				echo '<script>

						swal({

							type: "success",
							title: "¡La categoría ha sido borrada correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then(function(result){

							if(result.value){
							
								window.location = "categorias";

							}

						});
				

					</script>';

			}

		}

	}
	
	

}


