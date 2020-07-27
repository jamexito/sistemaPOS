<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar Venta

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Editar   Venta</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">
      
      <!--===================================
      =            EL FORMULARIO            =
      ====================================-->      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>
            
          <form role="form" method="POST" class="formularioVenta">

            <div class="box-body">
                
                <div class="box">

                  <?php 

                  $item = "id";
                  $valor = $_GET["idVenta"];

                  $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                  $itemUsuario = "id";
                  $valorUsuario = $venta["id_vendedor"];

                  $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  $itemCliente = "id";
                  $valorCliente = $venta["id_cliente"];

                  $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  $porcentajeImpuesto = $venta["impuestos"] * 100 / $venta["neto"];

                  ?>
                  
                  <!--====================================
                  =            ENTER VENDEDOR            =
                  =====================================-->                
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control" id="vendedorN" value="<?php echo $vendedor["nombre"]; ?>" readonly>
                      <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                    </div>

                  </div>

                  <!--=====================================
                  =            INTRO COD VENTA            =
                  ======================================-->
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control" id="ventaN" name="ventaE" value="<?php echo $venta["codigo"]; ?>" readonly>

                    </div>

                  </div>

                  <!--===================================
                  =            INTRO CLIENTE            =
                  ====================================-->
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>

                      <select class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                        
                        <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                        <?php 

                        $item = null;
                        $valor = null;

                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                        foreach ($clientes as $key => $value){

                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                        }

                        ?>

                      </select>

                      <span class="input-group-addon"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

                    </div>

                  </div>

                  <!--=======================================
                  =            INTRO FOR PRODUCT            =
                  ========================================-->
                  <div class="form-group row nuevoProducto">

                    <?php 

                    $listaProductos = json_decode($venta["productos"], true);

                    foreach ($listaProductos as $key => $value) {

                      $item = "id";
                      $valor = $value["id"];
                      $orden = "id";

                      $respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

                      $stockAntiguo = $respuesta["stock"]+$value["cantidad"];
                    
                      echo '<div class="row" style="padding: 5px 15px">

                                <!-- DESCRIPCION DEL PRODUCTO -->
                                <div class=" col-xs-12 col-sm-6 col-xs-11" style="padding-right: 0px">
                                  
                                  <div class="input-group">
                                    
                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                                    <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                                  </div>

                                </div>
                                
                                <!-- CANTIDAD DEL PRODUCTO -->
                                <div class="col-xs-6 col-sm-3 ingresoCantidad">
                                  
                                  <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

                                </div>

                                <!-- PRECIO DEL PRODUCTO -->
                                <div class="col-xs-6 col-sm-3 ingresoPrecio" style="padding-left: 0px">
                                  
                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                    
                                    <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>                    

                                  </div>

                                </div>

                            </div>';

                    }

                    ?>

                  </div>

                  <input type="hidden" id="listaProductos" name="listaProductos">
                  
                  <!-- BOTON PARA AGREGAR PRODUCTO -->
                  <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>
                  
                  <hr>

                  <div class="row">
                    
                    <!-- ENTRADA DE IMPUESTOS Y TOTAL -->
                    <div class="col-xs-11 pull-right">
                      
                      <table class="table">

                        <thead>

                          <tr>

                            <th>Impuesto</th>
                            <th>Total</th>
                            
                          </tr>
                          
                        </thead>

                        <tbody>

                          <tr>

                            <td style="width: 50%">
                              
                              <div class="input-group">

                                <span class="input-group-addon hidden-xs"><i class="fa fa-percent"></i></span>

                                <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo  $porcentajeImpuesto; ?>" required> 

                                <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuestos"]; ?>" required>

                                <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>                            
                                
                              </div>

                            </td>

                            <td style="width: 50%">

                              <div class="input-group">

                                <span class="input-group-addon hidden-xs"><i class="ion ion-social-usd"></i></span>

                                <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>" value="<?php echo $venta["total"]; ?>" readonly required> 

                                <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">                         
                                
                              </div>
                              
                            </td>
                            
                          </tr>
                          
                        </tbody>
                        
                      </table>

                    </div>

                  </div>

                  <hr>

                  <!-- ESCOGER METODO DE PAGO -->

                  <div class="form-group row">

                    <div class="col-xs-4" style="padding-right: 0px">

                      <div class="input-group">
                    
                        <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>

                          <option value="">Seleccione método de pago</option>
                          <option value="Efectivo">Efectivo</option>
                          <option value="TC">Tarjeta de crédito</option>
                          <option value="TD">Tarjeta de débito</option>

                        </select>

                      </div>
                      
                    </div>

                    <div class="cajasMetodoPago"></div>

                    <input type="hidden" name="listaMetodoPago" id="listaMetodoPago">
                    
                  </div> 

                  <br>

                </div>

            </div>

            <div class="box-footer">
              
              <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
              
            </div>

          </form>

          <?php 

          $editarVenta = new ControladorVentas();
          $editarVenta -> ctrEditarVenta();

          ?>

        </div>

      </div>

      <!--===========================================
      =            LA TABLA DE PRODUCTOS            =
      ============================================-->
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">
          
          <div class="box-header with-border">

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaVentas">

                <thead>

                  <tr>
                    
                    <th style="width: 10px">N°</th>
                    <th>Imagen</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Acciones</th>

                  </tr>
                  
                </thead>                
                
              </table>
              
            </div>
            
          </div>

        </div>

      </div>
      

    </div>

  </section>
  
</div>


<!--===========================================
=              MODAL ADD CLIENT               =
============================================-->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        
        <!--========================================
        =            HEADER - MODAL                =
        =========================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center" style="font-weight: bold;">Agregar Cliente</h4>

        </div>

        <!--======================================
        =               BODY - MODAL             =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">
            
            <!-- insert name -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="clienteN" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- insert document -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="documentoN" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- insert email -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="emailN" placeholder="Ingresar Email" required>

              </div>

            </div>
            
            <!-- insert telephon -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="telefonoN" placeholder="Ingresar teléfono" data-inputmask='"mask":"(999) 999-999"' data-mask required>

              </div>

            </div>

            <!-- insert direction -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="direccionN" placeholder="Ingresar dirección" required>

              </div>

            </div>

            <!-- insert f. nacimiento -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="fechaNacimientoN" placeholder="Ingresar fecha de nacimiento" data-inputmask='"alias":"yyyy/mm/dd"' data-mask  required>

              </div>

            </div>

          </div>

        </div>

        <!--=============================================
        =                 FOOTER MODAL                  =
        ==============================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Crear Cliente</button>

        </div>

      </form>

      <?php 

      $crearCliente = new ControladorClientes();
      $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>