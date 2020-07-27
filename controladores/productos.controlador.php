<?php 

/**
 * ControladorProductos
 * ctrMostrarProductos($item, $valor)
 */
class ControladorProductos
{

	/*=========================================
	=            MOSTRAR PRODUCTOS            =
	=========================================*/	
	static public function ctrMostrarProductos($item, $valor, $orden){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*======================================
	=            CREAR PRODUCTO            =
	======================================*/
	public function ctrCrearProducto(){

		if (isset($_POST["descripcionN"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionN"]) &&
				preg_match('/^[0-9]+$/', $_POST["stockN"]) &&
			    preg_match('/^[0-9.]+$/', $_POST["precioCompraN"]) &&
				preg_match('/^[0-9.]+$/', $_POST["precioVentaN"])) {

				/*======================================
				=            VALIDAR IMAGEN            =
				======================================*/
				$ruta = "vistas/img/productos/default/anonymous.png";

				if(isset($_FILES["imagenN"]["tmp_name"]) && !empty($_FILES["imagenN"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["imagenN"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["codigoN"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["imagenN"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["codigoN"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["imagenN"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["imagenN"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["codigoN"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["imagenN"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}				
				
				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["categoriaN"],
							   "codigo"       => $_POST["codigoN"],
							   "descripcion"  => $_POST["descripcionN"],
							   "stock"        => $_POST["stockN"],
							   "precio_compra"=> $_POST["precioCompraN"],
							   "precio_venta" => $_POST["precioVentaN"],
							   "imagen"         => $ruta);

				$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

							swal({

								type: "success",
								title: "¡El producto ha sido creado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
					

						</script>';

				}else{

					echo'<script>

							swal({

								type: "error",
								title: "¡Ha ocurrido un error al crear el producto!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
						

						</script>';

				}

			}else{

			       echo'<script>

							swal({

								type: "error",
								title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
						

						</script>';

			}

		}

	}

	/*=======================================
	=            EDITAR PRODUCTO            =
	=======================================*/
	public function ctrEditarProducto(){

		if (isset($_POST["descripcionE"])) {
			
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionE"]) &&
				preg_match('/^[0-9]+$/', $_POST["stockE"]) &&
			    preg_match('/^[0-9.]+$/', $_POST["precioCompraE"]) &&
				preg_match('/^[0-9.]+$/', $_POST["precioVentaE"])) {

				/*======================================
				=            VALIDAR IMAGEN            =
				======================================*/
				$ruta = $_POST["imagenActual"];

				if(isset($_FILES["imagenE"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["imagenE"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["codigoE"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);

					}

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["imagenE"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["codigoE"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["imagenE"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["imagenE"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["codigoE"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["imagenE"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}				
				
				$tabla = "productos";

				$datos = array("id_categoria" => $_POST["categoriaE"],
							   "codigo"       => $_POST["codigoE"],
							   "descripcion"  => $_POST["descripcionE"],
							   "stock"        => $_POST["stockE"],
							   "precio_compra"=> $_POST["precioCompraE"],
							   "precio_venta" => $_POST["precioVentaE"],
							   "imagen"         => $ruta);

				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

							swal({

								type: "success",
								title: "¡El producto ha sido editado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
					

						</script>';

				}else{

					echo'<script>

							swal({

								type: "error",
								title: "¡Ha ocurrido un error al editar el producto!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
						

						</script>';

				}

			}else{

			       echo'<script>

							swal({

								type: "error",
								title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
							}).then(function(result){

								if(result.value){
								
									window.location = "productos";

								}

							});
						

						</script>';

			}

		}
		
	}

	/*=========================================
	=            ELIMINAR PRODUCTO            =
	=========================================*/
	public function ctrEliminarUsuario(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			$datos = $_GET["idProducto"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png"){

				unlink($_GET["imagen"]);
				rmdir('vistas/img/productos/'.$_GET["codigo"]);

			}

			$respuesta = ModeloProductos::mdlEliminarUsuario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

			}		

		}

	}

	/*=========================================
	=          MOSTRAR SUMA VENTAS            =
	=========================================*/	
	static public function ctrMostrarSumaVentas(){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;

	}
	
	

}

