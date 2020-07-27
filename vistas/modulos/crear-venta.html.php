<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear Venta

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Crear Venta</li>

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
            
          <form role="form" method="POST">

            <div class="box-body">
                
                <div class="box">
                  
                  <!--====================================
                  =            ENTER VENDEDOR            =
                  =====================================-->                
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control" id="vendedorN" name="vendedorN" value="UsuarioAdministrador" readonly>

                    </div>

                  </div>

                  <!--=====================================
                  =            INTRO COD VENTA            =
                  ======================================-->
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>

                      <input type="text" class="form-control" id="ventaN" name="ventaN" value="10002343" readonly>

                    </div>

                  </div>

                  <!--===================================
                  =            INTRO CLIENTE            =
                  ====================================-->
                  <div class="form-group">
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>

                      <select class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                        
                        <option value="">Selccionar cliente</option>

                      </select>

                      <span class="input-group-addon"><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

                    </div>

                  </div>

                  <!--=======================================
                  =            INTRO FOR PRODUCT            =
                  ========================================-->
                  <div class="form-group row nuevoProducto">

                    <!-- DESCRIPCION DEL PRODUCTO -->
                    <div class="col-sm-6 col-xs-11" style="padding-right: 0px">
                      
                      <div class="input-group">
                        
                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                        <input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripcion del producto" required>

                      </div>

                    </div>
                    
                    <!-- CANTIDAD DEL PRODUCTO -->
                    <div class="col-sm-3 col-xs-6">
                      
                      <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>

                    </div>

                    <!-- PRECIO DEL PRODUCTO -->
                    <div class="col-sm-3 col-xs-6" style="padding-left: 0px">
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                        
                        <input type="number" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="0000" readonly required>                     

                      </div>

                    </div>

                  </div>
                  
                  <!-- BOTON PARA AGREGAR PRODUCTO -->
                  <button type="button" class="btn btn-default hidden-lg">Agregar producto</button>
                  
                  <hr>

                  <div class="row">
                    
                    <!-- ENTRADA DE IMPUESTOS Y TOTAL -->
                    <div class="col-xs-8 pull-right">
                      
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

                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>                             
                                
                              </div>

                            </td>

                            <td style="width: 50%">

                              <div class="input-group">

                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                <input type="number" class="form-control" min="1" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="0000" readonly required>                          
                                
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

                    <div class="col-xs-6" style="padding-right: 0px">

                      <div class="input-group">
                    
                        <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>

                          <option value="">Seleccione método de pago</option>
                          <option value="efectivo">Efectivo</option>
                          <option value="tarjetaCredito">Tarjeta de crédito</option>
                          <option value="tarjetaDebito">Tarjeta de débito</option>

                        </select>

                      </div>
                      
                    </div>

                    <div class="col-xs-6" style="padding-left: 0px">

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    
                        <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código de Tranzacción" required>                   

                      </div>
                      
                    </div>
                    
                  </div> 

                  <br>

                </div>

            </div>

            <div class="box-footer">
              
              <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>
              
            </div>

          </form>

        </div>

      </div>

      <!--===========================================
      =            LA TABLA DE PRODUCTOS            =
      ============================================-->
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">
          
          <div class="box-header with-border">

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablas">

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

                <tbody>

                  <tr>
                    
                    <td style="width: 10px">00001</td>
                    <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                    <td>00123</td>
                    <td>Lorem ipsum dolor sit amet</td>
                    <td>20</td>
                    <td>

                      <div class="btn-group">
                        
                        <button type="button" class=" btn btn-primary">Agregar</button>

                      </div>

                    </td>

                  </tr>
                  
                </tbody>
                
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