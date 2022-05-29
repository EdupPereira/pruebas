<!-- AGREGAR LA CLASE GUMP CUANDO TENGAMOS EL NUEVO SERVIDOR Y ASI PODER PONER RESTRINGCIONES EL EL TEXTO PW Y DEMAS -->
<?php 
include 'includes/adminheader.php';
include 'includes/adminnav.php';
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Publicar Post
            </h1>
            <?php
            if (isset($_POST['publish'])) {

                $post_title = $_POST['title'];
                $post_date = $_POST['fecha'];
                $post_tag = $_POST['tags'];
                $post_content = $_POST['content'];
                $link = $_POST['link'];
                if (isset($_SESSION['firstname'])) {
                    $post_author = $_SESSION['firstname'];
                }
                //$post_date = date('Y-m-d');
                $post_status = 'Borrador';
                $image = $_FILES['image']['name'];
                $ext = $_FILES['image']['type'];
                //validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
                if (empty($image)) {
                    echo "<script>alert('Adjunta una imagen');</script>";
                }
                // else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
                // {
                //     echo "<script>alert('El tamaño de la imagen no es correcto');</script>";
                // }
                // else if (!in_array($ext, $validExt)){
                //     echo "<script>alert('No es una imagen válida.');</script>";
                // }
                else {
                    $folder  = '../allpostpics/';
                    $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
                    $picture = rand(10000 , 10000000) .'.'.$imgext;
                    $archivo_noticia=$_FILES['archivo_noticia']['name'];
                    $guardar_pdf=$_FILES['archivo_noticia']['tmp_name'];
                    if($_FILES['archivo_noticia']['name'] > 0 ){
                        if(move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture) && move_uploaded_file($guardar_pdf,'../allpostpics/'.$archivo_noticia) ) {

                           $query = "INSERT INTO posts (title,author,postdate,image,content,status,tag,$link,pdf) VALUES ('$post_title' , '$post_author' , '$post_date' , '$picture' , '$post_content' , '$post_status', '$post_tag','$link','$archivo_noticia') ";
                           $result = pg_query($query);
                           if (pg_affected_rows($result) > 0) {
                            echo "<script> swal('Información publicada con éxito. Se publicará después de que el administrador lo apruebe');
                            window.location.href='posts.php';</script>";
                        }
                        else {
                            "<script> alert('Error al publicar ... intente de nuevo');</script>";
                        }

                    }

                }else{
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture) ) {
                       $query = "INSERT INTO posts (title,author,postdate,image,content,status,tag,link) VALUES ('$post_title' , '$post_author' , '$post_date' , '$picture' , '$post_content' , '$post_status', '$post_tag','$link') ";
                       $result = pg_query($query);
                       if (pg_affected_rows($result) > 0) {
                        echo "<script> swal('Información publicada con éxito. Se publicará después de que el administrador lo apruebe');
                        window.location.href='posts.php';</script>";
                    }
                    else {
                        "<script> alert('Error al publicar ... intente de nuevo');</script>";
                    }
                }
            }
        }

}
?>
<!--   FORMULARIO PARA UN NUEVO POST -->
<form role="form" action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Título del Post</label>
        <input type="text" name="title" placeholder = "Ingresa el título " value= "<?php if(isset($_POST['publish'])) { echo $post_title; } ?>"  class="form-control" required>
    </div>
    <div class="form-group ">
        <label for="post_title">Fecha</label>
        <input type="date" name="fecha" placeholder = "Ingresa el título " value= "<?php if(isset($_POST['publish'])) { echo $post_date; } ?>"  class="form-control" required>
    </div>

    <div class="form-group">
        <label for="post_image">Imagen de tu Post </label> <font color='brown' > &nbsp;&nbsp;(Tamaño máximo permitido 1024 Kb) </font> 
        <input type="file" name="image" >
    </div>
    <div class="form-group">
        <label for="post_tag">Tags</label>
        <input type="text" name="tags" placeholder = "Ingresa al menos un tag, separado por Coma (,)" value= "<?php if(isset($_POST['publish'])) { echo $post_tag; } ?>" class="form-control" >
    </div>
    <div class="form-group">
        <label for="post_tag">Link de video Youtube</label>
        <input type="text" name="link" placeholder = "Ingresa un link de un video en Youtube" value= "<?php if(isset($_POST['publish'])) { echo $link; } ?>" class="form-control" >
    </div>
    <div class="form-group">
        <label for="post_image">Archivo PDF </label> <font color='brown' > &nbsp;&nbsp;(Adjunta el archivo PDF de la noticia) </font> 
        <input type="file" name="archivo_noticia" >
    </div>
    <div class="form-group">
        <label for="post_content">Contenido del Post</label>
        <textarea class="form-control" name="content"  id="editor" cols="30" rows="15" ><?php if(isset($_POST['Publicado'])) { echo $post_content; } ?></textarea>
    </div>
    <button type="submit" name="publish" class="btn btn-primary" value="Publish Post">Publicar Post</button>

</form>

</div>


</div>


<script>
    // FUNCION PARA ACTIVAR EL EDITOR DE TEXTO
    initSample();
</script>
<?php 'includes/admin_footer.php';?> 


