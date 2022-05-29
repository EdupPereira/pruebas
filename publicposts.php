<?php include 'includes/header.php';?>
<!-- Navigation -->
<?php include 'includes/navbar.php';?>
<?php
if (isset($_GET['post'])) {
  $post = $_GET['post'];
  if (!is_numeric($post)) {
    header("location:index.php");

  } 
}
else {
  header('location: index.php');
}
$query = "SELECT * FROM posts WHERE id=$post";
$run_query = pg_query($conn, $query);
if (pg_num_rows($run_query) > 0 ) {
  while ($row = pg_fetch_array($run_query)) {
   $post_title = $row['title'];
   $post_id = $row['id'];
   $post_author = $row['author'];
   $post_date = $row['postdate'];
   $post_image = $row['image'];
   $post_content = $row['content'];
   $post_tags = $row['tag'];
   $post_status = $row['status'];
   $link = $row['link'];
   $pdf = $row['pdf'];
   ?>
   <!-- Page Content -->
   <div class="container">

    <div class="row">

      <!-- Blog Post Content Column -->
      <div class="col-lg-8 card col-md-8 col-xs-12 col-sm-12">

        <p><h2><a href="#"><?php echo $post_title; ?></a></h2></p>
        <p><span class="glyphicon glyphicon-time"></span>Publicado el <?php echo $post_date; ?></p>
        <center>
          <div class="col-md-12 x">
           <div class="ratio ratio-16x9">
            <img class=" img-responsive img-rounded" src="allpostpics/<?php echo $post_image; ?>"  alt="100 * 100">
          </div>
        </div>
      </center>
      <hr>


      <p class="col-md-8 mitexto"><?php echo $post_content; ?></p>
      <?php 
      if ($link != null) {?>
       <div class="col-md-12 x">
        <center>
          <div class="ratio ratio-16x9">
           <?php echo $link; ?>
         </div>

       </center>
       <br>
     </div>
     <?php 
   }
 ?>
       <?php 
      if ($pdf != null) {?>
       <div class="col-md-12 x">
        <center>
          <a href="./allpostpics/<?php echo $pdf; ?>" target="_blank"><button class=" btn btn-warning"> <i class="fa fa-download"></i> Descargar Noticia</button></a>

       </center>
       <br>
     </div>
     <?php 
   }
 ?>

 <!-- Go to www.addthis.com/dashboard to customize your tools -->
 <div class="d-none d-sm-none d-md-block addthis_inline_share_toolbox">
   <h4 class="d-none d-sm-none d-md-block">Comparte Esta Noticia</h4>
 </div>

<?php }} else { header("location: index.php"); } ?>
</div>

<!-- Columna Derecha -->
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
  <center>
    <h3 class="verde">Más Novedades</h3>
  </center>

  <?php

  $query = "SELECT * FROM posts WHERE status='Publicado' ORDER BY updated_on DESC";
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
      } else {?>

        <div class='col-md-12 col-xs-12 col-sm-12 '>
          <div class='module'>
            <div class='thumbnail'>
              <img src="allpostpics/<?php echo $post_image; ?>" height="250">
              <div class='date'>

                <div><?php  echo str_replace('-', '/', date('d', strtotime($post_date))); ?></div>
                <div>
                  <?php date_default_timezone_set('America/Bogota'); 
                  echo $fecha = date('M');
                  ?>
                </div>
              </div>
            </div>
            <div class="content">
              <div class="category"><?php echo $post_tags; ?></div>
              <p ><?php echo $post_title; ?></p>

              <div class="description"><?php echo substr($post_content, 0, 200) . '...'; ?></div>
              <div>

                <center>
                  <a href="publicposts.php?post=<?php echo $post_id; ?>" class="custom-btn btn-5">Leer mas</a><br>
                </center>
              </div>

            </div>
          </div>
        </div>
        <br>
      <?php }}}?>
    </div>
    <!-- /.row -->
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6102dc28253dae18"></script>
  </div>
</div>
<!-- /.container -->

<?php include 'includes/footer.php';?>

