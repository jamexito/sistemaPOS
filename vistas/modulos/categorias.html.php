<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Categorías

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

      <li class="active">Administrar Categorías</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCategoria">Agregar categoria</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas">
          
            <thead>
              
                <tr>
                  
                  <th style="width: 10px">N°</th>
                  <th>Categoría</th>
                  <th>Acciones</th>

                </tr>

            </thead>

            <tbody>
              
                <tr>
                  
                  <td>1</td>
                  <td>EQUIPOS ELECTROMECÁNICOS</td>
                  <td>
                    
                    <div class="btn-group">
                      
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>                  
  
                  </td>

                </tr>
                <tr>
                  
                  <td>1</td>
                  <td>EQUIPOS ELECTROMECÁNICOS</td>
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
=            MODAL ADD CATEGORIA              =
============================================-->
<div id="agregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">
        
        <!--========================================
        =            HEADER - MODAL                =
        =========================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center" style="font-weight: bold;">Agregar Categoría</h4>

        </div>

        <!--======================================
        =               BODY - MODAL             =
        =======================================-->
        <div class="modal-body">

          <div class="box-body">
            
            <!-- insert name -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="categoriaN" placeholder="Ingresar Categoría" required>

              </div>

            </div>

          </div>

        </div>

        <!--=============================================
        =                 FOOTER MODAL                  =
        ==============================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Crear Categoría</button>

        </div>

      </form>

    </div>

  </div>

</div>
