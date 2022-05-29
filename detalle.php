<?php include 'includes/header.php';?>
<!-- Navigation -->
<?php include 'includes/navbar.php';?>
<?php
if (isset($_GET['cod_rendicion'])) {
  $cod_rendicion = $_GET['cod_rendicion'];
  if (!is_numeric($cod_rendicion)) {
    header("location:index.php");

  } 
}
else {
  header('location: index.php');
}
$query = "SELECT * FROM rendicion WHERE cod_rendicion=$cod_rendicion";
$run_query = pg_query($conn, $query);
if (pg_num_rows($run_query) > 0 ) {
  while ($row = pg_fetch_array($run_query)) {
   $cod_rendicion = $row['cod_rendicion'];
   $video_rendicion =$row['video_rendicion'];
   $archivo_rendicion =$row['archivo_rendicion'];
   $encuesta_rendicion=$row['encuesta_rendicion'];
   $asistencia_rendicion =$row['asistencia_rendicion'];
   $estado_rendicion=$row['estado_rendicion'];
   $descripcion_rendicion =$row['descripcion_rendicion'];
   $fecha_rendicion=$row['fecha_rendicion'];
   $img_rendicion=$row['img_rendicion'];

   ?>
   <!-- Page Content -->
   <div class="container">

    <div class="row">

      <!-- Blog Post Content Column -->
      <div class="col-lg-8 card col-md-8 col-xs-12 col-sm-12">

        <p><h2><a href="#">Rendicion de Cuentas <?php echo $date; ?></a></h2></p>
        <center>
          <div class="col-md-12 x">
           <div class="ratio ratio-16x9">
            <?php echo $video_rendicion; ?>
        
            <img src="rendicion/<?php echo $img_rendicion; ?>" alt="">
          </div>
        </div>
      </center>
      <hr>
      <!-- Go to www.addthis.com/dashboard to customize your tools -->
      <div class="d-none d-sm-none d-md-block addthis_inline_share_toolbox">
       <h4 class="d-none d-sm-none d-md-block">Comparte Esta Información</h4>
     </div>

   <?php }} else { header("location: index.php"); } ?>
 </div>

 <!-- Columna Derecha -->
 <div class="col-md-4 col-lg-4 col-xs-12 col-xs-12 card">
  <center>
    <h3 class="verde">Opciones</h3>
  </center>
   <center>
    <a href="<?php echo $asistencia_rendicion; ?>" target="_blank"><button class="btn btn-primary pr-5">Asistencia</button></a>
    <a href="<?php echo $encuesta_rendicion; ?>" target="_blank"><button class="btn btn-primary pr-5">Encuesta</button></a>
    <a href="  https://forms.gle/hak6rC2dcABpgh3Q7" target="_blank"><button class="btn btn-primary pr-5">Preguntas</button></a>
    
  <hr>
  </center>
  <p class="col-md-12 mitexto text-justify"><?php echo $descripcion_rendicion; ?></p>
  <center>
  <a href="rendicion/<?php echo $archivo_rendicion; ?>" target="_blank"><button class="btn btn-primary pr-5">Documento PDF </button></a>
  </center>
</div>
<br><br><hr>
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
  <center>
    <h3 class="verde">Explorar</h3>

  </center>

  <?php

  $query = "SELECT * FROM rendicion WHERE estado_rendicion='Activo' AND cod_rendicion<>'$cod_rendicion' ORDER BY fecha_rendicion DESC";
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

     <?php }}}
     else{
      echo'
      <div class="col-md-12">
          <h4><center>Consulta nuestros proximos eventos en el <B>Calendario de actividades</B></center></h4>
          <p>Puedes descargar, imprimir o añadir la programacion a tu cuenta de Gmail</p>
          <iframe class="col-lg-12 col-sm-12 col-xs-12 col-md-12" src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=America%2FBogota&src=Y2FsZW5kYXJpb2FjdGl2aWRhZGVzZWR1cEBnbWFpbC5jb20&color=%23039BE5" style="border:solid 1px #777"  height="600" frameborder="0" scrolling="no"></iframe>
        </div>
        ';}?>
    </div>
    <!-- /.row -->
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6102dc28253dae18"></script>
  </div>
</div>
<!-- /.container -->

<?php include 'includes/footer.php';?>

