<?php 

if ($_SESSION["perfil"] == "Especial") {
  
  echo '<script>
    
          window.location = "inicio";

        </script>';

  return;

}

?>

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

              <?php 

              $item = null;
              $valor = null;

              $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

              foreach ($clientes as $key => $value) {
                
                echo '<tr>
                  
                        <td>'.($key+1).'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["documento"].'</td>
                        <td>'.$value["email"].'</td>
                        <td>'.$value["telefono"].'</td>
                        <td>'.$value["direccion"].'</td>
                        <td>'.$value["fecha_nacimiento"].'</td>
                        <td>'.$value["compras"].'</td>
                        <td>'.$value["ultima_compra"].'</td>
                        <td>'.$value["fecha"].'</td>
                        <td>
                          
                          <div class="btn-group">
                            
                              <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'">

                                <i class="fa fa-pencil"></i>

                              </button>';

                              if ($_SESSION["perfil"] == "Administrador") {
                                
                                echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'">

                                        <i class="fa fa-times"></i>

                                      </button>';

                              }                              

                      echo'</div>                  
        
                        </td>

                      </tr>';

              }

              ?>              
                
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

      <?php 

      $crearCliente = new ControladorClientes();
      $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>

<!--===========================================
=           MODAL UPDATE CLIENT               =
============================================-->
<div id="modalEditarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        
        <!--========================================
        =            HEADER - MODAL                =
        =========================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center" style="font-weight: bold;">Editar Cliente</h4>

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

                <input type="text" class="form-control input-lg" id="clienteE" name="clienteE" required>
                <input type="hidden" id="idCliente" name="idCliente">  
              
              </div>

            </div>

            <!-- insert document -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" id="documentoE" name="documentoE" required>

              </div>

            </div>

            <!-- insert email -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" id="emailE" name="emailE" required>

              </div>

            </div>
            
            <!-- insert telephon -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" id="telefonoE" name="telefonoE" data-inputmask='"mask":"(999) 999-999"' data-mask required>

              </div>

            </div>

            <!-- insert direction -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" id="direccionE" name="direccionE" required>

              </div>

            </div>

            <!-- insert f. nacimiento -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" id="fechaNacimientoE" name="fechaNacimientoE" data-inputmask='"alias":"yyyy/mm/dd"' data-mask  required>

              </div>

            </div>

          </div>

        </div>

        <!--=============================================
        =                 FOOTER MODAL                  =
        ==============================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php 

      $editarCliente = new ControladorClientes();
      $editarCliente -> ctrEditarCliente();

      ?>

    </div>

  </div>

</div>

<?php 

$eliminarCliente = new ControladorClientes();
$eliminarCliente -> ctrEliminarCliente();

?>
