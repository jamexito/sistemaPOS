<?php 

$item = null;
$valor = null;
$orden = "id";

$productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);

?>


<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Productos agregados recientemente</h3>

  </div>

  <div class="box-body">

    <ul class="products-list product-list-in-box">

      <?php 

      for ($i=0; $i < 10; $i++) { 
          
        echo '<li class="item">

                <div class="product-img">';

                if ($productos[$i]["imagen"]=="") {
                  
                  echo'<img src="vistas/img/productos/default/anonymous.png">';

                }else{

                  echo '<img src="'.$productos[$i]["imagen"].'">';

                }

                  

                echo'</div>

                <div class="product-info">

                  <a href="" class="product-title">'.$productos[$i]["descripcion"].'

                    <span class="label label-warning pull-right">S/. '.$productos[$i]["precio_venta"].'</span>

                  </a>

                </div>

              </li>';

      }

      ?>      

    </ul>

  </div>

  <div class="box-footer text-center">

    <a href="productos" class="uppercase">Ver todo los productos</a>

  </div>

</div>