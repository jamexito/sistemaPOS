<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarUsuario">Agregar Usuario</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas">
          
            <thead>
              
                <tr>
                  
                  <th>N°</th>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>Foto</th>
                  <th>Perfil</th>
                  <th>Estado</th>
                  <th>Último login</th>
                  <th>Acciones</th>

                </tr>

            </thead>

            <tbody>
              
                <tr>
                  
                  <td>1</td>
                  <td>Administrador</td>
                  <td>admin</td>
                  <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td>Adminsitrador</td>
                  <td><button class="btn btn-success btn-xs">Activado</button></td>
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
                  <td>Administrador</td>
                  <td>admin</td>
                  <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                  <td>Adminsitrador</td>
                  <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
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
=            MODAL ADD USER            =
============================================-->
<div id="agregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">
        
        <!--========================================
        =            HEADER - MODAL                =
        =========================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center" style="font-weight: bold;">Agregar Usuario</h4>

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

                <input type="text" class="form-control input-lg" name="nombreN" placeholder="Ingresar Nombre" required>

              </div>

            </div>
            
            <!-- insert user -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="text" class="form-control input-lg" name="usuarioN" placeholder="Ingresar Usuario" required>

              </div>

            </div>
            
            <!-- insert password -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="password" class="form-control input-lg" name="passwordN" placeholder="Ingresar Contraseña" required>

              </div>

            </div>

            <!-- selccionar su perfil -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select name="perfilN" class="form-control input-lg">
                  
                  <option value="">Seleccionar Perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- cargar la foto del usuario -->
            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" id="fotoN" name="fotoN">

              <p class="help-block">Peso máximo de la foto 200 MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">

            </div>

          </div>

        </div>

        <!--=============================================
        =                 FOOTER MODAL                  =
        ==============================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Crear Usuario</button>

        </div>

      </form>

    </div>

  </div>

</div>
