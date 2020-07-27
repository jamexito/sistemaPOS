<?php 

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos
{
	/*===================================================================
	=            MOSTRAR LA TABLA PRODUCTOS DE MODO DINAMICO            =
	===================================================================*/	
	public function mostrarTablaProductos(){

		$item = null;
	    $valor = null;
	    $orden = "id";

	    $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);		

	    $datosJson = '{

			  "data": [';

			  	for ($i=0; $i < count($productos); $i++) {

			  		if ($productos[$i]["imagen"] == "") {

			  			$imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>";
			  			
			  		}else{

			  			$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

			  		}			  		

			  		$item = "id";
			  		$valor = $productos[$i]["id_categoria"];

			  		$categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

			  		if ($productos[$i]["stock"] <= 10) {

			  			$stock = "<button class='bt btn-danger'>".$productos[$i]["stock"]."</button>";

			  		}elseif ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {

			  			$stock = "<button class='bt btn-warning'>".$productos[$i]["stock"]."</button>";

			  		}else{

			  			$stock = "<button class='bt btn-success'>".$productos[$i]["stock"]."</button>";

			  		}

			  		/*============================================
			  		=            TRAEMOS LAS ACCIONES            =
			  		============================================*/

			  		if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){
			  			
			  			$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button></div>";

			  		}else{			  		

			  			$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";

			  		}
			  		
	  		     $datosJson .= '[
							      "'.($i+1).'",
							      "'.$imagen.'",
							      "'.$productos[$i]["codigo"].'",
							      "'.$productos[$i]["descripcion"].'",
							      "'.$categoria["categoria"].'",
							      "'.$stock.'",
							      "S/.'.$productos[$i]["precio_compra"].'",
							      "S/.'.$productos[$i]["precio_venta"].'",
							      "'.$productos[$i]["fecha"].'",
							      "'.$botones.'"
							    ],';

			  	}

			$datosJson = substr($datosJson, 0, -1);

	$datosJson .= ']

			}';

		echo $datosJson;

	}

}

/*=====================================================
=            ACTIVAR LA TABLA DE PRODUCTOS            =
=====================================================*/
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();
