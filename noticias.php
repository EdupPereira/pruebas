<?php include 'includes/connection.php';

?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar.php';?>

<div class="container card">
  <div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
      <h2 class="ps-4">Noticias</h2>
    </div>

    <?php
    //PAGINACION
    $limite=6;
    $count=0;
    //CALCULAR BOTONES
    $result = pg_query($conn, "SELECT * FROM posts WHERE status='Publicado'");

    if (pg_num_rows($result) > 0) {
      while ($row = pg_fetch_assoc($result)) {
        $count++;
      }
    }
    $totalBotones=round($count/$limite);

    if (isset($_GET['limite'])) {
      $limitep=$_GET['limite'];
      $query = "SELECT * FROM posts WHERE status='Publicado' ORDER BY postdate DESC LIMIT '$limite' offset '$limitep'";
    }else{
      $query = "SELECT * FROM posts WHERE status='Publicado' ORDER BY postdate DESC LIMIT ".$limite;
    }
    //CONSULTA POST
    
    $run_query = pg_query($conn, $query);
    if (pg_num_rows($run_query) > 0) {
      while ($row = pg_fetch_assoc($run_query)) {

        $post_title = $row['title'];
        $post_id = $row['id'];
        $post_author = $row['author'];
        $post_date = $row['postdate'];
        $post_image = $row['image'];
        $post_content = $row['content'];
        $post_tags = $row['tag'];
        $post_status = $row['status'];
        if ($post_status !== 'Publicado') {
          echo "NO POST PLS";
        } else {

          ?>
          <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12 pt-3">
            <div class='normal'>
              <div class='module'>
                <div class='thumbnail'>
                  <img src="allpostpics/<?php echo $post_image; ?>" height="300">
                  <div class='date'>

                    <div><?php  echo str_replace('-', '/', date('d', strtotime($post_date))); ?></div>
                    <div>
                      <?php date_default_timezone_set('America/Bogota'); ?>
                      <?php  echo str_replace('-', '/', date('M', strtotime($post_date))); ?>
                      <?php  echo str_replace('-', '/', date('Y', strtotime($post_date))); ?>
                    </div>
                  </div>
                </div>
                <div class="content">
                  <div class="category"><?php echo $post_tags; ?></div>
                  <div class="sub-title">
                    <p><?php echo $post_title; ?></p>
                  </div>
                  <div class="description">
                    <p><?php echo $post_content; ?></p>
                  </div>
                  <div class="col align-self-end text-center">                              
                   <a href="publicposts.php?post=<?php echo $post_id; ?>" class="custom-btn btn-5">Leer mas</a>
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
                  echo '<li class="page-item"><a class="page-link" href="noticias.php?'.($_GET['limite']-6).'">Anterior</a></li>';
                }
              }
              for($k=0; $k<$totalBotones; $k++){
                echo '<li class="page-item"><a class="page-link" href="noticias.php?limite='.($k*6).'">'.($k+1).'</a></li>';
              }
              if (isset($_GET['limite'])) {
                if ($_GET['limite']+6 < $totalBotones*6) {
                  echo '<li class="page-item"><a class="page-link" href="noticias.php?'.($_GET['limite']+6).'">Siguiente</a></li>';
                }
              }else{
                echo '<li class="page-item"><a class="page-link" href="noticias.php?limite=6">Siguiente</a></li>';
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

