

<!-- Page Wrapper -->
<div id="wrapper" >
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-cogs"></i>
            </div>
            <div class="sidebar-brand-text mx-2">Panel de Control <sup> EDUP</sup></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <!-- Nav Item - Dashboard -->
        <?php 
        if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin") {
            echo '
            <li class="nav-item active">
            <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
            </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Parametizacion
            </div>
            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#config"
            aria-expanded="true" aria-controls="config">
            <i class="fas fa-config fa-folder"></i>
            <span>Configuración</span>
            </a>
            <div id="config" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones:</h6>
            <a class="collapse-item" href="./slider.php">Slider</a>
            <a class="collapse-item" href="./roles.php">Roles</a>
            <a class="collapse-item" href="./area.php">Área</a>
            <a class="collapse-item" href="./estados.php">Estados</a>
            <a class="collapse-item" href="./tipopersona.php">Tipo Persona</a>
            <a class="collapse-item" href="./tipoidentidad.php">Tipo de Identidad</a>
            <a class="collapse-item" href="./tiposolicitud.php">Tipo de Solicitud</a>
            </div>
            </div>
            </li>
            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transparencia"
            aria-expanded="true" aria-controls="transparencia">
            <i class="fas fa fa-gavel"></i>
            <span>Ley Transparencia</span>
            </a>
            <div id="transparencia" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones:</h6>
            <a class="collapse-item" href="./categorias.php">Categorias</a>
            <a class="collapse-item" href="./subcategorias.php">Subcategorias</a>
            <a class="collapse-item" href="./subcategorias.php">Matriz Ita</a>
            <a class="collapse-item" href="cargar.php">Montar Info General</a>
            <a class="collapse-item" href="./glosario.php">Glosario</a>
            <a class="collapse-item" href="./preguntas.php">Preguntas & Respuestas</a>
            <a class="collapse-item" href="./empresa.php">Empresa</a>
            <a class="collapse-item" href="./directorio.php">Directorios</a>
            <a class="collapse-item" href="./rendicion_cuentas.php">Rendicion de Cuentas</a>
            </div>
            </div>
            </li>

            ';
        }
        ?>
        <?php 
        if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin" || $_SESSION['role'] == "user" && $_SESSION['area']=="Comunicaciones" ) {
            echo ' 
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
            Noticias
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#publicaciones"
            aria-expanded="true" aria-controls="publicaciones">
            <i class="fas fa-file-signature"></i>
            <span>Publicaciones</span>
            </a>
            <div id="publicaciones" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones</h6>
            <a class="collapse-item" href="./posts.php">Ver todos los Post</a>
            <a class="collapse-item" href="./publishnews.php">Agregar un nuevo Post</a>
            </div>
            </div>
            </li>
            ';
        }
        ?>
        <?php 
        if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin" || $_SESSION['role'] == "user" && $_SESSION['area']=="PQRSFD" ) {
            echo '
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            PQRSFD
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pqrsfd"
            aria-expanded="true" aria-controls="pqrsfd">
            <i class="fas fa-users fa-folder"></i>
            <span>PQRSFD</span>
            </a>
            <div id="pqrsfd" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Administrar:</h6>
            <a class="collapse-item" href="verpqrsd.php">PQRSFD</a>
            </div>
            </div>
            </li>
            ';
        }
        ?>
        <?php 
        if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin") {
            echo '
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            Usuarios
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usuarios"
            aria-expanded="true" aria-controls="usuarios">
            <i class="fas fa-users fa-folder"></i>
            <span>Usuarios</span>
            </a>
            <div id="usuarios" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Opciones:</h6>
            <a class="collapse-item" href="./users.php">Usuarios</a>
            <a class="collapse-item" href="adduser.php">Agregar Usuario</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            1
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mecanismos"
            aria-expanded="true" aria-controls="mecanismos">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Mecanismos de Contacto del Sujeto Obligado</span>
            </a>
            <!-- Divider -->
            <div id="mecanismos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="mecanismos.php">Administrar</a>
            </div>
            </div>
            </li>
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            2
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#info"
            aria-expanded="true" aria-controls="info">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Información de Interés</span>
            </a>
            <!-- Divider -->
            <div id="info" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="info.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            3
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#organica"
            aria-expanded="true" aria-controls="organica">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Estructura Organica y Talento Humano</span>
            </a>
            <!-- Divider -->
            <div id="organica" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="organica.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            4
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Normatividad"
            aria-expanded="true" aria-controls="Normatividad">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Normatividad</span>
            </a>
            <!-- Divider -->
            <div id="Normatividad" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="normatividad.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            5
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Contabilidad"
            aria-expanded="true" aria-controls="Contabilidad">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Presupuesto</span>
            </a>
            <!-- Divider -->
            <div id="Contabilidad" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="estados.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            6
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#planeacion"
            aria-expanded="true" aria-controls="planeacion">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Planeación</span>
            </a>
            <!-- Divider -->
            <div id="planeacion" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="planeacion.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            7
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#control"
            aria-expanded="true" aria-controls="control">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Control</span>
            </a>
            <!-- Divider -->
            <div id="control" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="control.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            8
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contratacion"
            aria-expanded="true" aria-controls="contratacion">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Contratación</span>
            </a>
            <!-- Divider -->
            <div id="contratacion" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="contratacion.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            9
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tramites"
            aria-expanded="true" aria-controls="tramites">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Tramites y Servicios</span>
            </a>
            <!-- Divider -->
            <div id="tramites" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="tramites.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            10
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#instrumentos"
            aria-expanded="true" aria-controls="instrumentos">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Instrumentos de Gestión de Información Publica </span>
            </a>
            <!-- Divider -->
            <div id="instrumentos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="instrumentos.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            11
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tpasiva"
            aria-expanded="true" aria-controls="tpasiva">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Transparencia Pasiva </span>
            </a>
            <!-- Divider -->
            <div id="tpasiva" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="tpasiva.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            12
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#criterio"
            aria-expanded="true" aria-controls="criterio">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Criterio Diferencial de Accesibilidad </span>
            </a>
            <!-- Divider -->
            <div id="criterio" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="criterio.php">Administrar</a>
            </div>
            </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            13
            </div>

            <!-- Menu para administrar Usuarios-->
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datos"
            aria-expanded="true" aria-controls="datos">
            <i class="fas fa-arrow-circle-right fa-5x"></i>
            <span>Protección de Datos Personales </span>
            </a>
            <!-- Divider -->
            <div id="datos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="datos.php">Administrar</a>
            </div>
            </div>
            </li>
            ';
        }
        ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <?php 
            if ($_SESSION['role'] == "superadmin" && $_SESSION['area']=="superadmin" || $_SESSION['role'] == "superadmin" && $_SESSION['area']=="PQRSD" ) {
                echo'
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>';?>
                <?php
                $query = "SELECT * FROM pqrsd_detalle WHERE estado_llegada='Pendiente'";
                $result = pg_query($conn, $query);
                $notificacion = pg_num_rows($result);

                ?>
                <span class="badge badge-danger badge-counter"><?php echo $notificacion; ?>+</span>
                </a>
                <!-- Counter - Alerts -->
                <?php
                $query = "SELECT pd.codigo_llegada,pd.fecha_llegada,pd.codigo_identidad_fk,pd.codigo_solicitud_fk,pd.codigo_pqrsd_fk,pd.codigo_persona_fk,pd.estado_llegada,ti.codigo_identidad,ti.nombre_identidad,ts.codigo_solicitud,ts.nombre_solicitud,pq.codigo_pqrsd,pq.identificacion_pqrsd,pq.nombres_pqrsd,pq.direccion_pqrsd,pq.departamento_pqrsd,pq.telefono_pqrsd,pq.correo_pqrsd,pq.descripcion_pqrsd,pq.archivo_pqrsd,pq.aceptar_pqrsd,tp.codigo_persona,tp.nombre_persona
                FROM pqrsd_detalle pd
                INNER JOIN tipo_identidad ti
                ON pd.codigo_identidad_fk = ti.codigo_identidad
                INNER JOIN tipo_solicitud ts
                ON pd.codigo_solicitud_fk = ts.codigo_solicitud
                INNER JOIN pqrsd pq
                ON pd.codigo_pqrsd_fk = pq.codigo_pqrsd
                INNER JOIN tipo_persona tp
                ON pd.codigo_persona_fk = tp.codigo_persona

                WHERE  pd.estado_llegada='Pendiente' ORDER BY pd.codigo_llegada DESC LIMIT 5";;
                $result = pg_query($conn, $query);


                if (pg_num_rows($result) > 0) {
                    echo '
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                    Alertas de PQRSFD
                    </h6>
                    ';
                    while ($fila2 = pg_fetch_array($result)) {
                        $codigo_llegada=$fila2['codigo_llegada'];
                        $fecha_llegada=$fila2['fecha_llegada'];
                        $nombre_identidad=$fila2['nombre_identidad'];
                        $nombre_solicitud=$fila2['nombre_solicitud'];
                        $identificacion_pqrsd=$fila2['identificacion_pqrsd'];
                        $nombres_pqrsd=$fila2['nombres_pqrsd'];
                        $estado=$fila2['estado_llegada'];
                        $date = date_create($fecha_llegada);
                        $fecha= date_format($date, 'd-m-Y ');

                        echo'
                        <a class="dropdown-item d-flex align-items-center" href="verpqrsd.php?r='.$codigo_llegada.'">
                        <div class="mr-3">
                        <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                        </div>
                        <div>
                        <div class="small text-gray-500">'.$fecha.'</div>
                        <div class="text-truncate">'.$nombre_solicitud.'</div>
                        <div class="small text-gray-500">'.$nombres_pqrsd.'</div>
                        </div>
                        </a>

                        ';

                    }
                    echo '
                    <a class="dropdown-item text-center small text-gray-500" href="verpqrsd.php">Ver Todas las Alertas</a>
                    </div>
                    ';
                }
                ?>
                <?php 


                echo'
                </li>
                ';
            }
            ?>



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown1" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['firstname']; ?></span>
                <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown1">
            <a class="dropdown-item" href="./profile.php?section=<?php echo $_SESSION['username']; ?>">
                <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                Perfil
            </a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Salir
            </a>
        </div>
    </li>

</ul>

</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="../logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Cerrar</a>
        </div>
    </div>
</div>
</div>

                
