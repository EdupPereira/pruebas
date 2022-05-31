<?php include 'includes/connection.php';?>
<?php include 'includes/adminheader.php';?>
<?php include 'includes/adminnav.php';?>
<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];  
}
else {
	header('location:posts.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
    $query = "SELECT * FROM posts WHERE id='$id'";
}
else {
    $query = "SELECT * FROM posts WHERE id='$id' AND author = '$currentuser'" ;
}
$run_query = pg_query($query);
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

     if (isset($_POST['update'])) {
        $post_title = $_POST['title'];
        $post_tag = $_POST['tags'];
        $post_content = $_POST['content'];
        $post_date = date('Y-m-d');
        $link = $_POST['link'];
        $archivo_noticia=$_FILES['archivo_noticia']['name'];
        $guardar_pdf=$_FILES['archivo_noticia']['tmp_name'];
        move_uploaded_file($guardar_pdf,'../allpostpics/'.$archivo_noticia);
        if ($_SESSION['role'] == 'user') {
         $post_status = 'Borrador';
     } else {
        $post_status = $_POST['status'];
    }



    $image = $_FILES['image']['name'];
    $ext = $_FILES['image']['type'];
    $validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
    if (empty($image)) {
     $picture = $post_image;
 }
 else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
 {
    echo "<script>alert('Tamaño de imagen incorrecto');
    window.location.href = 'editposts.php?id=$id';</script>";

}
else if (!in_array($ext, $validExt)){
    echo "<script>alert('Imagen no válida');
    window.location.href = 'editposts.php?id=$id';</script>";
    exit();
}
else {
    $folder  = '../allpostpics/';
    $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
    $picture = rand(1000 , 1000000) .'.'.$imgext;

    move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture);
    
}
if($link==0){
    $queryupdate = "UPDATE posts SET title = '$post_title' , tag = '$post_tag' , content='$post_content' ,  status = '$post_status' , image = '$picture' , postdate = '$post_date', pdf = '$archivo_noticia' WHERE id= '$post_id' " ;
    $result = pg_query($queryupdate);
    if (pg_affected_rows($result) > 0) {
     echo "<script>alert('Publicación actualizada satisfactoriamente');
     window.location.href= 'posts.php';</script>";
 }
 else {
    echo "<script>alert('Error! .. vuélvelo a intentar');</script>";
}
}else{
    $queryupdate = "UPDATE posts SET title = '$post_title' , tag = '$post_tag' , content='$post_content' ,  status = '$post_status' , image = '$picture' , postdate = '$post_date',link='$link', pdf = '$archivo_noticia' WHERE id= '$post_id' " ;
    $result = pg_query($queryupdate);
    if (pg_affected_rows($result) > 0) {
     echo "<script>alert('Publicación actualizada satisfactoriamente');
     window.location.href= 'posts.php';</script>";
 }
 else {
    echo "<script>alert('Error! .. vuélvelo a intentar');</script>";
}

}


}
}
}
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Editar Noticia
            </h1>
            <form role="form" action="" method="POST" enctype="multipart/form-data">


             <div class="form-group">
              <label for="post_title">Titulo</label>
              <input type="text" name="title" class="form-control" value="<?php echo $post_title;  ?>">
          </div>

          <div class="form-group">
              <label for="post_tags">Tags</label>
              <input type="text" name="tags" class="form-control" value="<?php echo  $post_tags; ?>">
          </div>
          <div class="form-group">
            <label for="post_tag">Link de video Youtube</label>
            <input type="text" name="link" placeholder = "Inserta un video en Youtube" value= "" class="form-control" >
            <center>
                <hr>
                <?php  echo $link; ?>
            </center>
        </div>

        <div class="input-group">
          <label for="post_status">Estado</label>
          <select name="status" class="form-control">
           <?php if($_SESSION['role'] == 'user') { echo "<option value='Borrador' >Borrador</option>"; } else { ?> 
            <option value="<?php  echo $post_status; ?>"><?php  echo  $post_status;  ?></option>>
            <?php
            if ($post_status == 'Publicado') {
             echo "<option value='Borrador'>Borrador</option>";
         } else {
             echo "<option value='Publicado'>Publicado</option>";
         }
         ?>
         <?php
     }
     ?>


 </select>

</div>
<br>
<div class="form-group">
    <label for="post_image">Imagen</label>
    <img class="img-responsive" width="200" src="../allpostpics/<?php echo $post_image; ?>" alt="Photo">
    <input type="file" name="image"> 
</div>
<div class="form-group">
    <label for="pdf">Archivo PDF</label>
    <?php  
    if ($pdf != null) {?>

      <a href="../allpostpics/<?php echo $pdf; ?>" target="_blank" class="btn btn-warning">Descargar PDF</a>
      <?php  
  }?>
  <input type="file" name="archivo_noticia"> 
</div>
<div class="form-group">
    <label for="post_content">Contenido</label>
    <textarea   name="content" id="" class="ckeditor form-control"><?php  echo $post_content;  ?>
</textarea>
</div>
<button type="submit" name="update" class="btn btn-warning" value="Update Post">Editar</button>
</form>
</div> <!-- CAJA -->
</div> <!-- ROW -->
</div><!-- CONTAINER -->





</div>
<?php include 'includes/adminfooter.php';?>



