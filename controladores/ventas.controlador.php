<?php 

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * ControladorVentas
 * ctrMostrarVentas($item, $valor)
 */
class ControladorVentas
{

	/*======================================
	=            MOSTRAR VENTAS            =
	======================================*/	
	static public function ctrMostrarVentas($item, $valor){
		
		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*======================================
	=            REALIZAR VENTA            =
	======================================*/
	public function ctrCrearVenta(){
		
		if (isset($_POST["ventaN"])) {
			
			/*===================================================================================================================
			=            ACTUALIZAR LAS COMPRAS DEL CLIENTE, REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS            =
			===================================================================================================================*/
			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = null;

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor,$orden);

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1 = "compras";
			$valor1 = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1, $valor1, $valor);

			$item2 = "ultima_compra";

			/*=============================================
			REGISTRAR FECHA PARA SABER LA ULTIMA COMPRA
			=============================================*/
			date_default_timezone_set('America/Lima');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');

			$valor2 = $fecha.' '.$hora;

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item2, $valor2, $valor);

			/*=========================================
			=            GUARDAR LA COMPRA            =
			=========================================*/
			$tabla = "ventas";

			$datos = array("id_vendedor" => $_POST["idVendedor"],
						   "id_cliente" => $_POST["seleccionarCliente"],
						   "codigo" => $_POST["ventaN"],
						   "productos" => $_POST["listaProductos"],
						   "impuestos" => $_POST["nuevoPrecioImpuesto"],
						   "neto" => $_POST["nuevoPrecioNeto"],
						   "total" => $_POST["totalVenta"],
						   "metodo_pago" => $_POST["listaMetodoPago"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			if ($respuesta == "ok") {

				/*==================================================================
				=            CONFIGURACION PARA LA IMPRESION DEL TICKET            =
				==================================================================*/				

				// $impresora = "epson20";

				// $conector = new WindowsPrintConnector($impresora);

				// $imprimir = new Printer($conector);

				// $imprimir -> text("hola Mundo"."\n");

				// $imprimir -> cut();

				// $imprimir -> close();

				$impresora = "epson20";

				$conector = new WindowsPrintConnector($impresora);

				$printer = new Printer($conector);

				$printer -> setJustification(Printer::JUSTIFY_CENTER);

				$printer -> text(date("Y-m-d H:i:s")."\n"); //fecha de la factura

				$printer -> feed(1); //alimentamos el papel 1 vez

				$printer -> text("Inventory System S.A."."\n"); //Nombre de la empresa

				$printer -> text("RUC: 20770374671"."\n"); //ruc de la empresa

				$printer -> text("Dirección: Calle San Benito 156B"."\n"); //direccion de la empresa

				$printer -> text("Teléfono: 985647582"."\n"); //Telefono de la empresa

				$printer -> text("FACTURA N°" .$_POST["ventaN"]."\n"); //nUMERO DE FACTURA

				$printer -> feed(1); //alimentamos el papel 1 vez

				$printer -> text("Cliente:" .$traerCliente["nombre"]."\n"); //Nombre del cliente

				$printer -> text("Documento:" .$traerCliente["documento"]."\n"); //documento del cliente

				$printer -> text("Dirección:" .$traerCliente["direccion"]."\n"); //Nombre del cliente

				$tablaVendedor = "usuarios";
				$item = "id";
				$valor = $_POST["idVendedor"];

				$traerVendedor = ControladorUsuarios::ctrMostrarUsuarios($tablaVendedor, $item, $valor);

				$printer -> text("Cliente:" .$traerVendedor["nombre"]."\n"); //Nombre del vendedor

				$printer -> feed(1); //alimentamos el papel 1 vez

				foreach ($listaProductos as $key => $value) {

					$printer -> setJustification(Printer::JUSTIFY_LEFT);

					$printer -> text($value["descripcion"]."\n"); //Nombre del producto

					$printer -> setJustification(Printer::JUSTIFY_RIGHT);

					$printer -> text("S/. ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = S/. ".number_format($value["total"],2)."\n"); //Precio y cantidad e del producto

				}

				$printer -> feed(1); //alimentamos el papel 1 vez

				$printer -> text("Neto: S/. ".number_format($_POST["nuevoPrecioNeto"],2)."\n"); //Precio neto del producto

				$printer -> text("Impuesto: S/. ".number_format($_POST["nuevoPrecioImpuesto"],2)."\n"); //Impuesto del producto

				$printer -> text("------------\n"); //Precio neto del producto

				$printer -> text("Total: S/. ".number_format($_POST["totalVenta"],2)."\n"); //total del producto

				$printer -> feed(1); //alimentamos el papel 1 vez

				$printer -> text("Muchas gracias por su compra"); //podemos tambien poner un pie de pagima

				$printer -> feed(3); //alimentamos el papel 3 veces

				$printer -> cut(); //cortamos el papel si la impresora tiene la opcion

				$printer -> pulse(); //Por medio de kla impresora mandamos un pulso, es util cuando hay cajon monedero

				$printer -> close();
				
				echo '<script>

				localStorage.removeItem("rango");

					swal({

						type: "success",
						title: "La venta ha sido guardada correctamente",
						showConfimButton: true,
						confirmButtonText: "Cerrar"
						}).then((result) => {

							if(result.value){

								window.location = "crear-venta";

							}

						})					
			
				</script>';

			}
			

		}

	}

	/*======================================
	=             EDITAR VENTA             =
	======================================*/
	public function ctrEditarVenta(){
		
		if (isset($_POST["ventaE"])) {

			/*====================================================================
			=            FORMATEAR LAS TABLAS DE PRODUCTOS Y CLIENTES            =
			====================================================================*/
			$tabla = "ventas";

			$item = "codigo";

			$valor = $_POST["ventaE"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*===============================================================
			=            PREGUNTAR SI VIENEN PRODUCTOS EDITADOS             =
			===============================================================*/
			if ($_POST["listaProductos"] == "") {
				
				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;

			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;

			}

			if ($cambioProducto) {		

				$productos = json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

					$item1a = "ventas";
					$valor1a =  $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);


				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);
			
				/*===================================================================================================================
				=            ACTUALIZAR LAS COMPRAS DEL CLIENTE, REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS            =
				===================================================================================================================*/
				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2= "id";

					$valor_2 = $value["id"];

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos, $item_2, $valor_2);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes, $item_2, $valor_2);

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados) + $traerCliente["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				/*=============================================
				REGISTRAR FECHA PARA SABER LA ULTIMA COMPRA
				=============================================*/
				date_default_timezone_set('America/Lima');

				$fecha_2 = date('Y-m-d');
				$hora_2 = date('H:i:s');

				$valor1b_2 = $fecha.' '.$hora;

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=========================================
			=            EDITAR LA COMPRA            =
			=========================================*/
			$datos = array("id_vendedor" => $_POST["idVendedor"],
						   "id_cliente" => $_POST["seleccionarCliente"],
						   "codigo" => $_POST["ventaE"],
						   "productos" => $listaProductos,
						   "impuestos" => $_POST["nuevoPrecioImpuesto"],
						   "neto" => $_POST["nuevoPrecioNeto"],
						   "total" => $_POST["totalVenta"],
						   "metodo_pago" => $_POST["listaMetodoPago"]);

			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if ($respuesta == "ok") {
				
				echo '<script>

				localStorage.removeItem("rango");

					swal({

						type: "success",
						title: "La venta ha sido actualizada correctamente",
						showConfimButton: true,
						confirmButtonText: "Cerrar"
						}).then((result) => {

							if(result.value){

								window.location = "ventas";

							}

						})					
			
				</script>';

			}
			

		}

	}

	/*======================================
	=            ELIMINAR VENTA            =
	======================================*/
	public function ctrEliminarVenta(){
		
		if (isset($_GET["idVenta"])	) {
				
			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*======================================================
			=            ACTUALIZAR FECHA ULTIMA COMPRA            =
			======================================================*/
			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				  if ($value["id_cliente"] == $traerVenta["id_cliente"]) {
				  	
				  	array_push($guardarFechas, $value["fecha"]);

				  }
				
			}

			if (count($guardarFechas) > 1) {
				
				if ($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]) {
					
					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);	

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);	

				}

			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);	

			}

			/*===============================================================
			=            FROMATEAR TABLA DE PRODUCTOS Y CLIENTES            =
			===============================================================*/
			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = number_format($traerCliente["compras"]) - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=========================================
			=            ELIMINAR LA VENTA            =
			=========================================*/
			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if ($respuesta == "ok") {
			
				echo '<script>

					swal({

						type: "success",
						title: "La venta ha sido anulada correctamente",
						showConfimButton: true,
						confirmButtonText: "Cerrar"
						}).then((result) => {

							if(result.value){

								window.location = "ventas";

							}

						})					
			
				</script>';
			}			

		}

	}

	/*======================================
	=             RANGO FECHAS             =
	======================================*/	
	static public function ctrFechasVentas($fechaInicial, $fechaFinal){
		
		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;

	}

	/*======================================
	=           DESCARGAR EXCEL            =
	======================================*/	
	public function ctrDescargarReporte(){
		
		if (isset($_GET["reporte"])) {

			$tabla = "ventas";
			
			if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {
				
				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}

			/*===================================================
			=            CREAMOS EL ARCHIVO DE EXCEL            =
			===================================================*/
			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); //archivo de excel
			header("Cache-Control: cache, must-revalidate");
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public");
			header('Content-Disposition:; filename="'.$Name.'"');
			header('Pragma: public');
			header('Content-Transfer-Encoding: binary');

			echo utf8_decode("<table border='0'>

								<tr>

							      <td style='font-weight: bold; border: 1px solid #eee'>CÓDIGO</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>CLIENTE</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>VENDEDOR</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>CANTIDAD</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>PRODUCTOS</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>IMPUESTO</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>NETO</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>TOTAL</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>METODO DE PAGO</td>
							      <td style='font-weight: bold; border: 1px solid #eee'>FECHA</td>
							    
							    </tr>");

			foreach ($ventas as $row => $item) {
				
				$cliente = ControladorClientes::ctrMostrarClientes("id",$item["id_cliente"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("id",$item["id_vendedor"]);

				echo utf8_decode("<tr>
      
							      <td style='border: 1px solid #eee;'>".$item["codigo"]."</td>
							      <td style='border: 1px solid #eee;'>".$cliente["nombre"]."</td>
							      <td style='border: 1px solid #eee;'>".$vendedor["nombre"]."</td>
							      <td style='border: 1px solid #eee;'>");
				$productos = json_decode($item["productos"], true);

				foreach ($productos as $key => $valueProductos) {
					
					echo utf8_decode($valueProductos["cantidad"]."<br>");

				}

				echo utf8_decode("</td><td style='border: 1px solid #eee;'>");

				foreach ($productos as $key => $valueProductos) {
					
					echo utf8_decode($valueProductos["descripcion"]."<br>");

				}

				echo utf8_decode("</td>

								<td style='border: 1px solid #eee;'>S/. ".number_format($item["impuestos"],2)."</td>
								<td style='border: 1px solid #eee;'>S/. ".number_format($item["neto"],2)."</td>
								<td style='border: 1px solid #eee;'>S/. ".number_format($item["total"],2)."</td>
								<td style='border: 1px solid #eee;'>".$item["metodo_pago"]."</td>
								<td style='border: 1px solid #eee;'>".substr($item["fecha"],0,10)."</td>

					</tr>");

			}

			echo "</table>";

		}

	}

	/*=========================================
	=            SUMA TOTAL VENTAS            =
	=========================================*/
	public function ctrSumaTotalVentas(){
		
		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

	/*=====================================
	=            DESCARGAR XML            =
	=====================================*/
	static public function ctrDescargarXML(){

		if (isset($_GET["xml"])) {

			$tabla = "ventas";
			$item = "codigo";
			$valor = $_GET["xml"];

			$ventas = ModeloVentas::mdlMostrarVentas($tabla,$item,$valor);

			//PRODUCTOS
			$listaProductos = json_decode($ventas["productos"], true);

			//CLIENTES
			$tablaClientes = "clientes";

			$item = "id";
			$valor = $ventas["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			//VENDEDORES
			$tablaVendedor = "usuarios";
			$item = "id";
			$valor = $ventas["id_vendedor"];

			$traerVendedor = ControladorUsuarios::ctrMostrarUsuarios($tablaVendedor, $item, $valor);

			//https://www.php.net/manual/es/book.xmlwriter.php			
			$objetoXML = new XMLWriter();

			$objetoXML->openURI($_GET["xml"].".xml");//creacion del acrchivo xml

			$objetoXML->setIndent(true); //recibe el valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

			$objetoXML->setIndentString("\t"); //caracter que correesponden a una tabulacion 

			$objetoXML->startDocument('1.0', 'utf-8'); //inicio del documento

				// $objetoXML->startElement("etiquetaPrincipal");//inicio del nodo raiz

				// $objetoXML->writeAttribute("AttrPrincipal", "valor del atributo de la etiqueta principal");

				// 	$objetoXML->startElement("etiquetaInterna");//inicio del nodo hijo

				// 		$objetoXML->writeAttribute("AttrInterno", "valor del atributo de la etiqueta interna");

				// 		$objetoXML->text("Texto interno");

				// 	$objetoXML->endElement(); //final del nodo hijo

				// $objetoXML->endElement(); //final del nodo raiz

			$objetoXML->writeRaw('<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">');

			$objetoXML->writeRaw('<ext:UBLExtensions>');

			foreach ($listaProductos as $key => $value) {

				$objetoXML->text($value["descripcion"].",");	

			}


			$objetoXML->writeRaw('</ext:UBLExtensions>');

			$objetoXML->writeRaw('</Invoice>');

			$objetoXML->endDocument();//final del documento

			return true;

		}

		

	}	
	

}

