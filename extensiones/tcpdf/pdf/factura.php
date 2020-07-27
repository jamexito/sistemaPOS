<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){
	
//TRAEMOS LA INFORMACION DE VENTA
$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta,$valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"],true);
$neto = number_format($respuestaVenta["neto"],2);
$impuesto = number_format($respuestaVenta["impuestos"],2);
$total = number_format($respuestaVenta["total"],2);

//TRAEMOS LA INFORMACION DEL CLIENTE
$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);


//TRAEMOS LA INFORMACION DEL VENDEDOR
$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);


//REQURIMOS LA CLASE TCPDF


require 'tcpdf_include.php';


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//.......................................................................................................

$bloque1 = <<<EOF

	<table style="font-size:9px; text-align:center">

		<tr>
			
			<!--<td style="width:160px">

				<img src="images/logo-negro-bloque.png">

			</td>-->

			<td style="width:160px">
				
				<div>

					Fecha: $fecha

					<br><br>

					Razón Social: Inventory System S.A.

					<br>
					
					Doc./RUC: 77037467

					<br>

					Dirección: Calle Sigma Mz. B Lt. 16

					<br>

					Teléfono: 936 667 027

					<br>

					FACTURA N° $valorVenta

					<br><br>

					Cliente: $respuestaCliente[nombre]

					<br>

					Documento: $respuestaCliente[documento]

					<br>

					Vendedor: $respuestaVendedor[nombre]

					<br>

				</div>

			</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1,false,false,false,false, '');

//.......................................................................................................


foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"],2);
$precioTotal = number_format($item["total"],2);

$bloque2 = <<<EOF

	<table style="font-size:9">

	
			<!--<td style="border:1px solid #666; background-color:white; width:100px; text-align:center">S/. $valorUnitario</td>
			<td style="border:1px solid #666; background-color:white; width:100px; text-align:center">S/. $precioTotal</td>-->

		<tr>

			<td style="width:160px; text-align:left">$item[descripcion]</td>			

		</tr>

		<tr>

			<td style="width:160px; text-align:right">S/. $valorUnitario Und * $item[cantidad] S/. $precioTotal <br></td>			

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false, '');

}

//.......................................................................................................

$bloque3 = <<<EOF

	<table style="font-size:9px; text-align:right">

		<tr>

			<td style="width:80px;">Neto: </td>
			<td style="width:80px;">S/. $neto</td>

		</tr>

		<tr>

			<td style="width:80px;">Impuesto: </td>
			<td style="width:80px;">S/. $impuesto</td>

		</tr>

		<tr>

			<td style="width:160px;">--------------------</td>

		</tr>

		<tr>

			<td style="width:80px;">Total: </td>
			<td style="width:80px;">S/. $total</td>

		</tr>

		<tr>

			<td style="width:160px;">

				<br><br>
				Muchas gracias por su compra	
	
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque3,false,false,false,false, '');



//***********salida del archivo************//
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>