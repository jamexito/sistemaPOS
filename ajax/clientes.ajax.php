<?php 

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

/**
 * 
 */
class ClientesAjax 
{

	/*======================================
	=            EDITAR CLIENTE            =
	======================================*/	
	public $idCliente;

	public function editarClienteAjax(){
		
		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}


}

/*======================================
=            EDITAR CLIENTE            =
======================================*/
if (isset($_POST["idCliente"])) {
	
	$Cliente = new ClientesAjax();
	$Cliente -> idCliente = $_POST["idCliente"];
	$Cliente -> editarClienteAjax();

}