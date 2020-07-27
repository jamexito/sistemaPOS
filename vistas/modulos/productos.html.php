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

        <table class="table table-bordered table-striped dt-responsive tablas">
          
            <thead>
              
                <tr>
                  
                  <th style="width: 10px">N°</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descipción</th>
                  <th>Categoría</th>
                  <th>Stock</th>
                  <th>Precio de Compra</th>
                  <th>Precio de Venta</th>
                  <th>Agregado</th>
                  <th>Acciones</th>

                </tr>

            </thead>

            <tbody>
              
                <tr>
                  
                  <td>1</td>
                  <td>
                    <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px">
                  </td>
                  <td>001</td>
                  <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                  <td>Lorem Ipsum</td>
                  <td>200</td>
                  <td>S/. 5.00</td>
                  <td>S/. 5.50</td>
                  <td>2020-12-06 12:05:32</td>
                  <td>
                    
                    <div class="btn-group">
                      
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>                  
  
                  </td>

                </tr>

                <tr>
                  
                  <td>1</td>
                  <td>
                    <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px">
                  </td>
                  <td>001</td>
                  <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                  <td>Lorem Ipsum</td>
                  <td>200</td>
                  <td>S/. 5.00</td>
                  <td>S/. 5.50</td>
                  <td>2020-12-06 12:05:32</td>
                  <td>
                    
                    <div class="btn-group">
                      
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>                  
  
                  </td>

                </tr>

            </tbody>

        </table>

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
            
            <!-- insert code -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" name="codigoN" placeholder="Ingresar Código" required>

              </div>

            </div>
            
            <!-- insert description -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" name="descripcionN" placeholder="Ingresar Descripción" required>

              </div>

            </div>

            <!-- select category -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="categoriaN">
                  
                  <option value="">Seleccionar Categoría</option>

                  <option value="Taladros">Taladros</option>

                  <option value="Limpieza">Limpieza</option>

                  <option value="Aseo Personal">Aseo Personal</option>

                </select>

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

              <div class="col-xs-6">
                
                <!-- insert precio compra -->
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" name="precioCompraN" min="0" placeholder="Precio de Compra" required>

                </div>

              </div>
              
              <div class="col-xs-6">

                <!-- insert precio venta -->              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number" class="form-control input-lg" name="precioVentaN" min="0" placeholder="Precio de Venta" required>

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

              <input type="file" id="imagenN" name="imagenN">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="100px">

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

    </div>

  </div>

</div>
