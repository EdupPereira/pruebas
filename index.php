<?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>
<?php include 'includes/navbar.php';?>
<?php 


?>
<!-- SLIDER DE LA PAGINA DE INICIO -->
<div class="container card">
  <div id="carouselExampleCaptions" class="carousel slide col-md-12" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <!--   INDICADORES DEL SLIDER PARA PASARLO DESDE LA ZONA BOTTOM -->
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <!-- CONSULTA PARA IMPRIMIR EL PRIMER SLIDER ESTO CON EL FIN DE QUE SEA EL QUE ESTA ACTIVO (NO FUNCIONA SIN EL SLIDER ACTIVO) -->
      <?php

      $queryslider = "SELECT * FROM slider ";
      $run_query = pg_query($conn, $queryslider);

      if (pg_num_rows($run_query) > 0) {
        //CONTADOR PARA QUE EL PRIMER SLIDER SEA EL ACTIVO
        $i=1;
        while ($rows = pg_fetch_array($run_query)) {
          $id_slider = $rows['id_slider'];
          $img_slider = $rows['img_slider'];
          $titulo_slider = $rows['titulo_slider'];
          $texto_slider = $rows['texto_slider'];
          $boton_slider = $rows['boton_slider'];
          $enlace_slider = $rows['enlace_slider'];
          
          ?>


          <div class="carousel-item <?php if($i==1) echo "active"; ?>">
            <img src="slider/<?php echo $img_slider; ?>" class="d-block w-100" alt="..." height="480">
            <div class="mitexto carousel-caption  d-md-block">
              <h5><?php echo $titulo_slider; ?></h5>
              <p><?php echo $texto_slider; ?></p>
              <?php  
        // CONDICION PARA DETERMINAR SI LA VARIABLE ENLACE_SLIDER CONTIENE ALGUN ELEMENTO ENTONCES MUESTRE EL BOTON CON SU ENLACE 
              if (!empty($enlace_slider)) {?>

               <a href="<?php echo $enlace_slider ?>" target="_blank">
                 <button class="btn btn-primary"><?php echo $boton_slider ?></button>
               </a>

               <?php  
               $i++;
             }
             echo '   </div> 
             </div>';
           }
         }

         ?>

       </div>
       <!-- BOTONES DE ANTERIOR Y SIGUIENTE PARA PASAR EL SLIDER -->
       <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="fa fa-arrow-left fa 5x" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="fa fa-arrow-right fa 5x" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="font-controls">
      <div class="font-control" id="font-up"></div>
      <div class="font-control" id="font-down"></div>
    </div>
  </div>
  <br>

  <!-- ULTIMAS NOTICIAS -->
  <div class="container card"> <!-- DIV SESION ULTIMAS NOTICIAS -->
    <div class="row">
      <div class="col-md-12 ps-5">
        <h2>Novedades Edup</h2>

      </div>

      <?php
    // CONSULTA PARA MOSTRAR LAS ULTIMAS 2 NOTICIAS PUBLICADAS
      $querypost = "SELECT * FROM posts WHERE status='Publicado' ORDER BY id DESC LIMIT 2";
      $run_queryp = pg_query($conn, $querypost);
      if (pg_num_rows($run_queryp) > 0) {
        while ($rowp = pg_fetch_assoc($run_queryp)) {

          $post_title = $rowp['title'];
          $post_id = $rowp['id'];
          $post_author = $rowp['author'];
          $post_date = $rowp['postdate'];

          $post_image = $rowp['image'];
          $post_content = $rowp['content'];
          $post_tags = $rowp['tag'];
          $post_status = $rowp['status'];

          if ($post_status !== 'Publicado') {
            echo "NO POST HAY POST PUBLICADOS";
          } else {

            ?>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
              <div class="normal">
                <div class="module">
                  <div class="thumbnail">
                    <img src="allpostpics/<?php echo $post_image; ?>" height="300">
                    <div class='date'>

                      <div><?php  echo str_replace('-', '/', date('d', strtotime($post_date))); ?></div>
                      <div>
                        <?php date_default_timezone_set('America/Bogota'); ?>
                        <?php  echo str_replace('-', '/', date('M', strtotime($post_date))); ?>
                      </div>
                    </div>
                  </div>
                  <div class="content">
                    <div class="category"><?php echo $post_tags; ?></div>
                    <p ><?php echo $post_title; ?></p>

                    <!-- <div class="description"><?php echo substr($post_content, 0, 400) . '...'; ?></div> -->
                    <div>
                      <center>
                        <a href="publicposts.php?post=<?php echo $post_id; ?>" class="custom-btn btn-5">Leer mas</a>
                      </center>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          <?php }}}?>
          <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12"> <!-- DIV PARA MAS NOTICIAS -->
            <div class='normal'>
              <div class='module'>
                <div class="thumbnail">
                  <img src="image/noticia.png" alt="">
                  <div class='date'>
                    <i class="pt-2 fa fa-plus fa-lg"></i>
                  </div>
                </div>

                <div class="content">
                 <p class="sub-title">¿Quieres leer más noticias que te pueden interesar?</p>
                 <div>
                  <br>
                  <center>

                    <a href="noticias.php" class="custom-btn btn-5">Noticias</a>
                  </center>
                </div>

              </div>
            </div>
          </div>

        </div><!--  CIERRA EL DIV DE MAS NOTICIAS -->
      </div>

    </div> <!-- CIERRA DIV DE ULTIMAS NOTICIAS -->
    <br>
    <div class="container card">
      <div class="row">
        <br>
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12 ">
         <div data-mc-src="144e6651-48d5-4204-9375-4f9a87d34925#instagram"></div>

       </div>
       <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
        <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/XQGG6kdd4f0" title="YouTube video" style="max-width: 100%;height: 100%;" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div> 
  <!-- SLIDER DE ALIADOS -->
  <br>
  <div class="container card">
    <div class="row customer-logos slider ps-2">
      <div class="slide col-xs-6 col-sm-6">
        <img src="image/gobierno-en-linea.png">
      </div>
      <div class="slide col-xs-6 col-sm-6">
        <a href="https://www.pereira.gov.co/" target="_blank">
          <img src="image/alcaldia-pereira.png">
        </a>
      </div>
      <div class="slide col-xs-6 col-sm-6">
        <a href="" target="_blank">
          <img src="image/portal.png">
        </a>
      </div>
      <div class="slide col-xs-6 col-sm-6">
        <a href="https://idm.presidencia.gov.co/" target="_blank">
          <img src="image/presidencia-republica.png">
        </a>
      </div>
      <div class="slide col-xs-6 col-sm-6">
        <a href="https://www.procuraduria.gov.co/portal/" target="_blank">
          <img src="image/procuraduria-nacion.png">
        </a>
      </div>
    </div>

  </div> <!-- CIERRA DIV DE ALIADOS -->

</div>
<!-- FOOTER DE LA PAGINA -->
<?php include 'includes/footer.php';?>


