<?php 


require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class categoriasAjax
{

	/*========================================
	=            EDITAR CATEGORIA            =
	========================================*/
	public $idCategoria;

	public function editarCategoriaAjax(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}
	

}


/*========================================
=            EDITAR CATEGORIA            =
========================================*/
if (isset($_POST["idCategoria"])) {
	
	$categoria = new categoriasAjax();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> editarCategoriaAjax();

}













