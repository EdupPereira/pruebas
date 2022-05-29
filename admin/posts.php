<?php include 'includes/adminheader.php';
?>


<?php include 'includes/adminnav.php';?>


<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">
                <div class="col-xs-4">
                    <a href="publishnews.php" class="btn btn-primary">Agregar Post</a>
                </div>
                <center>
                    Todos los post
                </center>
            </h3>


            <?php if($_SESSION['role'] == 'superadmin')  
            { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">

                            <form action="" method="post">
                                <table id="tabla_post" class="table table-bordered table-striped table-hover">


                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Autor</th>
                                            <th>Título</th>
                                            <th>Estado</th>
                                            <th>Imagen</th>
                                            <th>Tags</th>
                                            <th>Fecha</th>
                                            <th>Ver Post</th>
                                            <th>Editar</th>
                                            <th>Borrar</th>
                                            <th>Publicar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                       <?php

                                       $query = "SELECT * FROM posts ORDER BY id DESC";
                                       $run_query = pg_query($conn, $query);
                                       if (pg_num_rows($run_query) > 0) {
                                        while ($row = pg_fetch_array($run_query)) {
                                            $post_id = $row['id'];
                                            $post_title = $row['title'];
                                            $post_author = $row['author'];
                                            $post_date = $row['postdate'];
                                            $post_image = $row['image'];
                                            $post_content = $row['content'];
                                            $post_tags = $row['tag'];
                                            $post_status = $row['status'];

                                            echo "<tr>";
                                            echo "<td>$post_id</td>";
                                            echo "<td>$post_author</td>";
                                            echo "<td>$post_title</td>";
                                            echo "<td>$post_status</td>";
                                            echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
                                            echo "<td>$post_tags</td>";
                                            echo "<td>$post_date</td>";
                                            echo "<td><a href='post.php?post=$post_id' style='color:green'>Ver Post</a></td>";
                                            echo "<td><a class='btn btn-warning' href='editposts.php?id=$post_id'><span class='far fa-edit' style='color: #265a88;'></span></a></td>";
                                            echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta publicación?')\" href='?del=$post_id'><i class='fa fa-trash-alt'></i></a></td>";
                                            echo "<td><a class='btn btn-info' onClick=\"javascript: return confirm('¿Estás seguro de que deseas publicar esta publicación?')\"href='?pub=$post_id'>Publicar</a></td>";

                                            echo "</tr>";

                                        }
                                    }
                                    else {
                                        echo "<script>swal('No hay publicaciones aún');
                                        window.location.href= 'publishnews.php';</script>";
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['del'])) {
                $post_del =pg_escape_string($conn,$_GET['del']);
                $del_query = "DELETE FROM posts WHERE id='$post_del'";
                $run_del_query = pg_query($conn, $del_query);
                if (pg_affected_rows($run_del_query) > 0) {
                    echo "<script>swal('Publicación eliminada con éxito');
                    window.location.href='posts.php';</script>";
                }
                else {
                   echo "<script>swal('Ocurrió un error. Intente nuevamente!');</script>";   
               }
           }
           if (isset($_GET['pub'])) {
            $post_pub = pg_escape_string($conn,$_GET['pub']);
            $pub_query = "UPDATE posts SET status='Publicado' WHERE id='$post_pub'";
            $run_pub_query = pg_query($conn, $pub_query);
            if (pg_affected_rows($run_pub_query) > 0) {
                echo "<script>swal('Post publicado satisfactoriamente');
                window.location.href='posts.php';</script>";
            }
            else {
               echo "<script>swal('Ocurrió un error. Intente nuevamente');</script>";   
           }
       }

       ?>
       <?php 
   }
   else if($_SESSION['role'] == 'admin') {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">

                <form action="" method="post">
                    <table class="table table-bordered table-striped table-hover">


                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Autor</th>
                                <th>Título</th>
                                <th>Estado</th>
                                <th>Imagen</th>
                                <th>Tags</th>
                                <th>Fecha</th>
                                <th>Ver Post</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                                <th>Publicar</th>
                            </tr>
                        </thead>
                        <tbody>

                           <?php
                           $currentuser = $_SESSION['firstname'];
                           $query = "SELECT * FROM posts WHERE author = '$currentuser' ORDER BY id DESC";
                           $run_query = pg_query($conn, $query);
                           if (pg_affected_rows($run_query) > 0) {
                            while ($row = pg_fetch_array($run_query)) {
                                $post_id = $row['id'];
                                $post_title = $row['title'];
                                $post_author = $row['author'];
                                $post_date = $row['postdate'];
                                $post_image = $row['image'];
                                $post_content = $row['content'];
                                $post_tags = $row['tag'];
                                $post_status = $row['status'];

                                echo "<tr>";
                                echo "<td>$post_id</td>";
                                echo "<td>$post_author</td>";
                                echo "<td>$post_title</td>";
                                echo "<td>$post_status</td>";
                                echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
                                echo "<td>$post_tags</td>";
                                echo "<td>$post_date</td>";
                                echo "<td><a href='post.php?post=$post_id' style='color:green'>Ver Post</a></td>";
                                echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta publicación?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>borrar</a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas publicar esta publicación?')\"href='?pub=$post_id'><i class='fa fa-times' style='color: red;'></i>Publicar</a></td>";

                                echo "</tr>";

                            }
                        }
                        else {
                            echo "<script>swal('¡Aún no has publicado nada! Comienza a publicar ahora');
                            window.location.href= 'publishnews.php';</script>";
                        }
                        ?>


                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET['del'])) {
    $post_del =pg_escape_string($conn,$_GET['del']);
    $del_query = "DELETE FROM posts WHERE id='$post_del'";
    $run_del_query = pg_query($conn, $del_query);
    if (pg_affected_rows($run_del_query) > 0) {
        echo "<script>swal('Publicación borrada satisfactoriamente');
        window.location.href='posts.php';</script>";
    }
    else {
       echo "<script>swal('Ocurrió un error. Intente nuevamente!');</script>";   
   }
}

if (isset($_GET['pub'])) {
    $post_pub = pg_escape_string($conn,$_GET['pub']);
    $pub_query = "UPDATE posts SET status='Publicado' WHERE id='$post_pub'";
    $run_pub_query = pg_query($conn, $pub_query);
    if (pg_affected_rows($run_pub_query) > 0) {
        echo "<script>swal('Post publicado satisfactoriamente');
        window.location.href='posts.php';</script>";
    }
    else {
       echo "<script>swal('Ocurrió un error. Intente nuevamente!');</script>";   
   }
}

?>
<?php 
}
else {
    ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">

                <form action="" method="post">
                    <table class="table table-bordered table-striped table-hover">
                       <thead>
                        <tr>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Imagen</th>
                            <th>Tags</th>
                            <th>Fecha/th>
                                <th>Ver Post</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tbody>

                           <?php
                           $currentuser = $_SESSION['firstname'];

                           $query = "SELECT * FROM posts WHERE author = '$currentuser' ORDER BY id DESC";
                           $run_query = pg_query($conn, $query);
                           if (pg_affected_rows($run_query) > 0) {
                            while ($row = pg_fetch_array($run_query)) {
                                $post_id = $row['id'];
                                $post_title = $row['title'];
                                $post_author = $row['author'];
                                $post_date = $row['postdate'];
                                $post_image = $row['image'];
                                $post_content = $row['content'];
                                $post_tags = $row['tag'];
                                $post_status = $row['status'];

                                echo "<tr>";
                                echo "<td>$post_title</td>";
                                echo "<td>$post_status</td>";
                                echo "<td><img  width='100' src='../allpostpics/$post_image' alt='Post Image' ></td>";
                                echo "<td>$post_tags</td>";
                                echo "<td>$post_date</td>";
                                echo "<td><a href='post.php?post=$post_id' style='color:green'>Ver Post</a></td>";
                                echo "<td><a href='editposts.php?id=$post_id'><span class='glyphicon glyphicon-edit' style='color: #265a88;'></span></a></td>";
                                echo "<td><a onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar esta publicación?')\" href='?del=$post_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";

                                echo "</tr>";

                            }
                        }
                        else {
                            echo "<script>swal('¡Aún no has publicado nada! Comienza a publicar ahora');
                            window.location.href= 'publishnews.php';</script>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_GET['del'])) {
    $post_del = pg_escape_string($conn, $_GET['del']);
    $del_query = "DELETE FROM posts WHERE id='$post_del' AND author='$currentuser'";
    $run_del_query = pg_query($conn, $del_query);
    if (pg_affected_rows($run_del_query) > 0) {
        echo "<script>alert('Publicación eliminada con éxito');
        window.location.href='posts.php';</script>";
    }
    else {
       echo "<script>swal('Ocurrió un error. Intenta nuevamente');</script>";   
   }
}
?>
<?php    
}
?>
</div>
</div>
</div>

<?php include ('includes/adminfooter.php');?>


