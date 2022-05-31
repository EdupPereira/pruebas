<?php 
include 'includes/adminheader.php';
include 'includes/adminnav.php';
?>


<!-- Content Row -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
       <!--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a> -->
        </div>
        <div class="row">
            <!-- CARD DE NOTICIAS -->
            <?php 
            if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin" || $_SESSION['role'] == "user" && $_SESSION['area']=="Comunicaciones" ) {
                echo ' 
                <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-20">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">';?>
                <?php
                $query = "SELECT * FROM posts";
                $result = pg_query($conn, $query);
                $post_num = pg_num_rows($result);

                ?>


                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Post</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo "{$post_num}"; ?></div>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    <br>
                    <a href="posts.php">  <span class="pull-left">Ver todos los Post</span></a> </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  
}?>
<!-- CARD DE USUARIOS  -->
<?php 
if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin" ) {
    echo '
    <div class="col-xl-4 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
    <div class="row no-gutters align-items-center">
    <div class="col mr-2">'?>
    <?php
    $query = "SELECT * FROM users";
    $result = pg_query($conn, $query);
    $user_num = pg_num_rows($result);
    ?>
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
        Usuarios
    </div>
    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo "{$user_num}"; ?></div>
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
        <br>
        <a href="users.php">  <span class="pull-left">Ver todos los Usuarios</span></a> </div>
    </div>
    <div class="col-auto">
        <i class="fas fa-user fa-2x text-gray-300"></i>
    </div>
</div>
</div>
</div>
</div>

</div>
<?php  
}?>
<!--  CARD DE PQRSFD -->
<?php 
if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin" || $_SESSION['role'] == "user" && $_SESSION['area']=="PQRSFD" ) {
    echo ' 
    <div class="col-xl-4 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-20">
    <div class="card-body">
    <div class="row no-gutters align-items-center">
    <div class="col mr-2">';?>
    <?php
    $pqrsd_sql = "SELECT * FROM pqrsd_detalle WHERE estado_llegada='Pendiente'";
    $result_pqrsd = pg_query($conn, $pqrsd_sql);
    $num_pqrsfd = pg_num_rows($result_pqrsd);

    ?>


    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
    PQRSFD</div>
    <div class="h5 mb-0 font-weight-bold  text-danger"><?php  echo "{$num_pqrsfd}"; ?></div>
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
        <br>
        <a href="verpqrsd.php"> <span class="pull-left">Responder lo PQRSFD pendientes</span></a> </div>
    </div>
    <div class="col-auto">
        <i class="fas fa-question  fa-2x text-gray-300"></i>
    </div>
</div>
</div>
</div>
</div>
<?php  
}?>
</div>  
</div><!-- DIV QUE CIERRA EL CONTENEDOR DEL NAV -->
<?php include ('includes/adminfooter.php');?>


