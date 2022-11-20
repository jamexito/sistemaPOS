<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Productos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#crearProducto">Crear Producto</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaProductos">
          
            <thead>
              
                <tr>
                  
                  <th style="width: 10px">N°</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descipción</th>
                  <th>Categoría</th>
                  <th>Stock</th>
                  <th>P. Compra</th>
                  <th>P. Venta</th>
                  <th>Agregado</th>
                  <th>Acciones</th>

                </tr>

            </thead>           

        </table>

        <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>
  
</div>

<!--===========================================
=              MODAL ADD PRODUCT              =
============================================-->
<div id="crearProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        
        <!--========================================
        =            HEADER - MODAL                =
        =========================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center" style="font-weight: bold;">Agregar Producto</h4>

        </div>

        <!--======================================
        =               BODY - MODAL             =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">

            <!-- select category -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="categoriaN" name="categoriaN" required>
                  
                  <option value="">Seleccionar Categoría</option>

                  <?php 

                  $item = null;
                  $valor = null;

                  $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categoria as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                  }

                  ?>

                </select>

              </div>

            </div>
            
            <!-- insert code -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="codigoN" name="codigoN" placeholder="Ingresar Código" required>

              </div>

            </div>
            
            <!-- insert description -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="descripcionN" placeholder="Ingresar Descripción" required>

              </div>

            </div>         

            <!-- insert stock -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="stockN" min="0" placeholder="Stock" required>

              </div>

            </div>
            
            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
                
                <!-- insert precio compra -->
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="precioCompraN" name="precioCompraN" min="0" step="any" placeholder="Precio de Compra" required>

                </div>

              </div>
              
              <div class="col-xs-12 col-sm-6">

                <!-- insert precio venta -->              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="precioVentaN" name="precioVentaN" min="0" step="any" placeholder="Precio de Venta" required>

                </div>

                <br>

                <!-- CCHECKCBOX PARA PORCENTAJE -->
                <div class="col-xs-6">
                  
                  <div class="form-group">
                    
                    <label>
                      
                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar Procentaje

                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA EL PORCENTAJE -->
                <div class="col-xs-6" style="padding: 0">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- cargar la foto del usuario -->
            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="imagenN" name="imagenN">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=============================================
        =                 FOOTER MODAL                  =
        ==============================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Crear Producto</button>

        </div>

      </form>

      <?php 

      $crearProducto = new ControladorProductos();
      $crearProducto ->ctrCrearProducto();

      ?>

    </div>

  </div>

</div>

<!--===========================================
=           MODAL UPDATE PRODUCT              =
============================================-->
<div id="modalEditarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        
        <!--========================================
        =            HEADER - MODAL                =
        =========================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center" style="font-weight: bold;">Editar Producto</h4>

        </div>

        <!--======================================
        =               BODY - MODAL             =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">

            <!-- select category -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="categoriaE" readonly required>
                  
                  <option id="categoriaE"></option>

                </select>

              </div>

            </div>
            
            <!-- insert code -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="codigoE" name="codigoE" required readonly>

              </div>

            </div>
            
            <!-- insert description -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="descripcionE" name="descripcionE" required>

              </div>

            </div>         

            <!-- insert stock -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" id="stockE" name="stockE" min="0" required>

              </div>

            </div>
            
            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">
                
                <!-- insert precio compra -->
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="precioCompraE" name="precioCompraE" min="0" step="any" required>

                </div>

              </div>
              
              <div class="col-xs-12 col-sm-6">

                <!-- insert precio venta -->              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" id="precioVentaE" name="precioVentaE" min="0" readonly required>

                </div>

                <br>

                <!-- CCHECKCBOX PARA PORCENTAJE -->
                <div class="col-xs-6">
                  
                  <div class="form-group">
                    
                    <label>
                      
                      <input type="checkbox" class="minimal porcentaje" checked>
                      Utilizar Procentaje

                    </label>

                  </div>

                </div>

                <!-- ENTRADA PARA EL PORCENTAJE -->
                <div class="col-xs-6" style="padding: 0">
                  
                  <div class="input-group">
                    
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>

              </div>

            </div>

            <!-- cargar la foto del usuario -->
            <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="imagenN" name="imagenE">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="imagenActual" name="imagenActual">

            </div>

          </div>

        </div>

        <!--=============================================
        =                 FOOTER MODAL                  =
        ==============================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

      </form>

      <?php 

      $editarProducto = new ControladorProductos();
      $editarProducto ->ctrEditarProducto();

      ?>

    </div>

  </div>

</div>

<?php 

$eliminarProducto = new ControladorProductos();
$eliminarProducto ->ctrEliminarUsuario();

?>
