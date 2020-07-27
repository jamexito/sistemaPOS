<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Clientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Clientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCliente">Agregar cliente</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas">
          
            <thead>
              
                <tr>
                  
                  <th style="width: 10px">N°</th>
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>E-mail</th>
                  <th>Teléfono</th>
                  <th>Direccion</th>
                  <th>Fecha nacimiento</th>
                  <th>T. compras</th>
                  <th>Ultima compra</th>
                  <th>Ingreso al sistema</th>
                  <th>Acciones</th>

                </tr>

            </thead>

            <tbody>
              
                <tr>
                  
                  <td>1</td>
                  <td>Daniel amargo</td>
                  <td>2252125</td>
                  <td>dani@gmail.com</td>
                  <td>965842252</td>
                  <td>los alamos 158</td>
                  <td>1992-11-12</td>
                  <td>36</td>
                  <td>2020-09-15 10:20:03</td>
                  <td>2020-09-15 10:20:03</td>
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
=              MODAL ADD CLIENT               =
============================================-->
<div id="agregarCliente" class="modal fade" role="dialog">
  
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

    </div>

  </div>

</div>
