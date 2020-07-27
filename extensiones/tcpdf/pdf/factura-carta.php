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

$pdf->startPageGroup();

$pdf->AddPage();

//.......................................................................................................

$bloque1 = <<<EOF

	<table>

		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					<span style="font-weight:bold">Documento/RUC:</span> 77037467

					<br>
					<span style="font-weight:bold">Dirección:</span> Calle Sigma Mz. B Lt. 16

				</div>

			</td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					<span style="font-weight:bold">Teléfono:</span> 936 667 027

					<br>
					<span style="font-weight:bold">E-mail:</span>ejemplo@gmail.com

				</div>

			</td>

			<td style="background-color:white; width:110px; text-align:center; color: red"><br><br>FACTURA N°<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1,false,false,false,false, '');

//.......................................................................................................

$bloque2 = <<<EOF

	<table>

		<tr>

			<td style="width:540px"><img src="images/back.jpg" alt=""></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border:1px solid #666; background-color:white; width:410px">
				

				<span style="font-weight:bold">Cliente/Razón Social:  </span> $respuestaCliente[nombre]

			</td>

			<td style="border:1px solid #666; background-color:white; width:130px;">

				<span style="font-weight:bold">Fecha:  </span> $fecha
				
			</td>

		</tr>

		<tr>

			<td style="border:1px solid #666; background-color:white; width:180px">

				<span style="font-weight:bold">Documento/RUC:  </span>$respuestaCliente[documento]
				
			</td>

			<td style="border:1px solid #666; background-color:white; width:360px">

				<span style="font-weight:bold">Dirección:  </span>$respuestaCliente[direccion]
				
			</td>

		</tr>

		<tr>

			<td style="border:1px solid #666; background-color:white; width:540px">

				<span style="font-weight:bold">Vendedor:  </span>$respuestaVendedor[nombre]
				
			</td>

		</tr>

		<tr>

			<td style="border-bottom:1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false, '');

//.......................................................................................................

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border:1px solid #666; background-color:white; width:260px; font-weight:bold; text-align:center">Producto</td>
			<td style="border:1px solid #666; background-color:white; width:80px; font-weight:bold; text-align:center">Cantidad</td>
			<td style="border:1px solid #666; background-color:white; width:100px; font-weight:bold; text-align:center">Valor Unit.</td>
			<td style="border:1px solid #666; background-color:white; width:100px; font-weight:bold; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3,false,false,false,false, '');

//.......................................................................................................


foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto,$valorProducto,$orden);

$valorUnitario = number_format($respuestaProducto["precio_venta"],2);
$precioTotal = number_format($item["total"],2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border:1px solid #666; background-color:white; width:260px;">$item[descripcion]</td>
			<td style="border:1px solid #666; background-color:white; width:80px; text-align:center">$item[cantidad]</td>
			<td style="border:1px solid #666; background-color:white; width:100px; text-align:center">S/. $valorUnitario</td>
			<td style="border:1px solid #666; background-color:white; width:100px; text-align:center">S/. $precioTotal</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque4,false,false,false,false, '');

}

//.......................................................................................................

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border-bottom:1px solid #666; background-color:white; width:100px; text-align:center"></td>
			<td style="border-bottom:1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>

		<tr>

			<td style="border-right:1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border:1px solid #666; background-color:white; width:100px; text-align:center; font-weight:bold">Neto: </td>
			<td style="border:1px solid #666; color:#333; background-color:white; width:100px; text-align:center">S/. $neto</td>

		</tr>
		<tr>

			<td style="border-right:1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border:1px solid #666; background-color:white; width:100px; text-align:center; font-weight:bold">Impuesto: </td>
			<td style="border:1px solid #666; color:#333; background-color:white; width:100px; text-align:center">S/. $impuesto</td>

		</tr>
		<tr>

			<td style="border-right:1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border:1px solid #666; background-color:white; width:100px; text-align:center; font-weight:bold">Total: </td>
			<td style="border:1px solid #666; color:#333; background-color:white; width:100px; text-align:center">S/. $total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5,false,false,false,false, '');


//***********salida del archivo************//
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>