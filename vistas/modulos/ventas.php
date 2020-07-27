<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$xml = ControladorVentas::ctrDescargarXML();

if ($xml) {

  rename($_GET["xml"].".xml", "xml/".$_GET["xml"].".xml");
  
  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/'.$_GET["xml"].'.xml" href="ventas">Se ha creado correctramente el archivo xml <span class=" fa fa-times pull-right"></span></a>';

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Ventas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Ventas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-venta">
          
          <button class="btn btn-primary">Generar venta</button>

        </a>  

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
          
          <span>
            <i class="fa fa-calendar"></i>Rango de fecha
          </span>

          <i class="fa fa-caret-down"></i>

        </button>      

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas">
          
            <thead>
              
                <tr>
                  
                  <th style="width: 10px">N°</th>
                  <th>N° Comprobante</th>
                  <th>Cliente</th>
                  <th>Vendedor</th>
                  <th>Forma de pago</th>
                  <th>Neto</th>
                  <th>Total</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                  <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

              <?php 

              if (isset($_GET["fechaInicial"])) {
                
                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal = $_GET["fechaFinal"];

              }else{
                $fechaInicial = null;
                $fechaFinal = null;

              }
              
              $respuesta = ControladorVentas::ctrFechasVentas($fechaInicial, $fechaFinal);

              foreach ($respuesta as $key => $value) {
                
                echo '<tr>
                  
                        <td>'.($key+1).'</td>
                        <td>'.$value["codigo"].'</td>';

                        $item = "id";
                        $valor = $value["id_cliente"];

                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                        echo'<td>'.$clientes["nombre"].'</td>';

                        $item = "id";
                        $valor = $value["id_vendedor"];

                        $Usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                        echo'<td>'.$Usuarios["nombre"].'</td>
                        <td>'.$value["metodo_pago"].'</td>
                        <td>S/. '.number_format($value["neto"],2).'</td>
                        <td>S/. '.number_format($value["total"],2).'</td>
                        <td>'.$value["fecha"].'</td>';
                        if($value["estado"] != 0){

                          echo '<td><button class="btn btn-success btn-xs">Activado</button></td>';

                        }else{

                          echo '<td><button class="btn btn-danger btn-xs">Anulado</button></td>';

                        }
                        echo'<td>
                          
                          <div class="btn-group">

                            <a class="btn btn-success" href="index.php?ruta=ventas&xml='.$value["codigo"].'">xml</a>
                            
                              <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'" title="Imprimir">

                                <i class="fa fa-print"></i>

                              </button>';

                              if($value["estado"] != 0 && $_SESSION["perfil"] == "Administrador"){

                                echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'" title="Editar"><i class="fa fa-pencil"></i></button>

                                      <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'" title="Anular"><i class="fa fa-times"></i></button>';

                              }/*else{

                                echo '<button class="btn btn-default"><i class="fa fa-pencil"></i></button>

                                      <button class="btn btn-default"><i class="fa fa-times"></i></button>';

                              }*/

                              

                          echo'</div>                  
        
                        </td>

                      </tr>';

              }

              ?>
              
                

            </tbody>

        </table>

        <?php 

        $eliminarVenta = new ControladorVentas();
        $eliminarVenta -> ctrEliminarVenta();


        ?>

      </div>

    </div>

  </section>
  
</div>

