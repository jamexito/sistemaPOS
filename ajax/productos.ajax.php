<?php 


require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class ProductosAjax
{

	/*===============================================================
	=            GENERAR CODIGO A PARTIR DE ID CATEGORIA            =
	===============================================================*/
	public $idCategoria;

	public function crearCodigoProductosAjax(){

		$item = "id_categoria";
		$valor = $this->idCategoria;
		$orden = "id";

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		echo json_encode($respuesta);

	}

	/*=======================================
	=            EDITAR PRODUCTO            =
	=======================================*/
	public $idProducto;
	public $traerProductos;
	public $nombreProducto;

	public function editarProductoAjax(){

		if ($this->traerProductos == "ok") {
			
			$item = null;
			$valor = null;
			$orden = "id";

			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

			echo json_encode($respuesta);

		}else if ($this->nombreProducto != "") {
			
			$item = "descripcion";
			$valor = $this->nombreProducto;
			$orden = "id";

			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

			echo json_encode($respuesta);

		}

		else{

			$item = "id";
			$valor = $this->idProducto;
			$orden = "id";

			$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

			echo json_encode($respuesta);

		}	

	}
	

}

/*===============================================================
=            GENERAR CODIGO A PARTIR DE ID CATEGORIA            =
===============================================================*/
if (isset($_POST["idCategoria"])) {
	
	$codigoProducto = new ProductosAjax();
	$codigoProducto -> idCategoria = $_POST["idCategoria"];
	$codigoProducto -> crearCodigoProductosAjax();

}

/*=======================================
=            EDITAR PRODUCTO            =
=======================================*/
if (isset($_POST["idProducto"])) {
	
	$editarProducto = new ProductosAjax();
	$editarProducto -> idProducto = $_POST["idProducto"];
	$editarProducto -> editarProductoAjax();

}


/*=======================================
=            TRAER PRODUCTO             =
=======================================*/
if (isset($_POST["traerProductos"])) {
	
	$traerProductos = new ProductosAjax();
	$traerProductos -> traerProductos = $_POST["traerProductos"];
	$traerProductos -> editarProductoAjax();

}

/*=======================================
=      TRAER NOMBRE PRODUCTO           =
=======================================*/
if (isset($_POST["nombreProducto"])) {
	
	$traerProductos = new ProductosAjax();
	$traerProductos -> nombreProducto = $_POST["nombreProducto"];
	$traerProductos -> editarProductoAjax();

}



