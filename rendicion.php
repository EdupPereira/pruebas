<?php include 'includes/connection.php';

?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar.php';?>

<div class="container card">
  <div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
      <h2 class="ps-4">Rendición de Cuentas</h2>
    </div>

    <?php
    //PAGINACION
    $limite=6;
    $count=0;
    //CALCULAR BOTONES
    $result = pg_query($conn, "SELECT * FROM rendicion WHERE estado_rendicion='Activo'");

    if (pg_num_rows($result) > 0) {
      while ($row = pg_fetch_assoc($result)) {
        $count++;
      }
    }
    $totalBotones=round($count/$limite);

    if (isset($_GET['limite'])) {
      $limitep=$_GET['limite'];
      $query = "SELECT * FROM rendicion WHERE estado_rendicion='Activo' ORDER BY fecha_rendicion DESC LIMIT '$limite' offset '$limitep'";
    }else{
      $query = "SELECT * FROM rendicion WHERE estado_rendicion='Activo' ORDER BY fecha_rendicion DESC LIMIT ".$limite;
    }
    //CONSULTA POST
    
    $run_query = pg_query($conn, $query);
    if (pg_num_rows($run_query) > 0) {
      while ($row = pg_fetch_assoc($run_query)) {

        $cod_rendicion = $row['cod_rendicion'];
        $video_rendicion =$row['video_rendicion'];
        $archivo_rendicion =$row['archivo_rendicion'];
        $encuesta_rendicion=$row['encuesta_rendicion'];
        $asistencia_rendicion =$row['asistencia_rendicion'];
        $estado_rendicion=$row['estado_rendicion'];
        $descripcion_rendicion =$row['descripcion_rendicion'];
        $fecha_rendicion=$row['fecha_rendicion'];
        $img_rendicion=$row['img_rendicion'];
        if ($estado_rendicion !== 'Activo') {
          echo "No existen datos.";
        } else {

          ?>
          <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 pt-3">
            <div class='normal'>
              <div class='module'>
                <div class='thumbnail'>
                 <div class="ratio ratio-16x9">
                  <?php echo $video_rendicion; ?>
                  <img src="rendicion/<?php echo $img_rendicion; ?>" alt="">
                 </div>
                 <div class='date'>

                  <div><?php  echo str_replace('-', '/', date('d', strtotime($fecha_rendicion))); ?></div>
                  <div>
                    <?php date_default_timezone_set('America/Bogota'); ?>
                    <?php  echo str_replace('-', '/', date('M', strtotime($fecha_rendicion))); ?>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="category">Año <?php  echo str_replace('-', '/', date('Y', strtotime($fecha_rendicion))); ?></div>
                
                <div class="description">
                  <p><?php echo $descripcion_rendicion; ?></p>
                </div>
                <div class="col align-self-end text-center">  
                <center>                            
                 <a href="detalle.php?cod_rendicion=<?php echo $cod_rendicion; ?>" class="custom-btn btn-5 btn">Leer mas</a>
                 </center>
               </div>
             </div>
           </div>
         </div>

       </div>

     <?php }}}?>

     <div class="m-4 col-lg-12 col-md-12 col-xs-12 col-sm-12  pt-5">
      <nav>
        <ul class="pagination justify-content-center">

          <ul class="pagination">
            <?php 
            if (isset($_GET['limite'])) {
              if ($_GET['limite']>0) {
                echo '<li class="page-item"><a class="page-link" href="rendicion.php?'.($_GET['limite']-6).'">Anterior</a></li>';
              }
            }
            for($k=0; $k<$totalBotones; $k++){
              echo '<li class="page-item"><a class="page-link" href="rendicion.php?limite='.($k*6).'">'.($k+1).'</a></li>';
            }
            if (isset($_GET['limite'])) {
              if ($_GET['limite']+6 < $totalBotones*6) {
                echo '<li class="page-item"><a class="page-link" href="rendicion.php?'.($_GET['limite']+6).'">Siguiente</a></li>';
              }
            }else{
              echo '<li class="page-item"><a class="page-link" href="rendicion.php?limite=6">Siguiente</a></li>';
            }

            ?>
          </ul>
        </nav>
      </div>


    </div>
  </div>


</div>
</div>
<?php include 'includes/footer.php';?>

