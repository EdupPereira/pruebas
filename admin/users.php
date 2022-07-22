<?php include ('includes/connection.php'); 
include "includes/adminheader.php";
include "includes/adminnav.php";

if (isset($_SESSION['role'])) {
    $currentrole = $_SESSION['role'];
} //COMPROBAS QUE SOLO LOS USUARIOS CON ROL ADMIN PUEDEN INGRESAR A ESTE MODULO
if ( $currentrole == 'user') {
    echo "<script> alert('SOLO EL ADMINISTRADOR PUEDE VER USUARIOS');
    window.location.href='./index.php'; </script>";
}
// SI EL QUE ACCEDE ES EL SUPERADMINISTRADOR SE LE MUESTRAN TODAS LAS OPCIONES PARA EDITAR Y ELIMINAR USUARIOS 
else if ($currentrole == 'superadmin') {
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <div class="col-xs-4">
                        <a href="adduser.php" class="btn btn-primary">Agregar Usuario</a>
                    </div>
                    <center>
                        Todos los Usuarios
                    </center>
                </h3>
                <div class="table-responsive">
                <table id="tabla_usuarios" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Area</th>
                            <th>Constraseña</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        //CONSULTAR TODOS LOS USUARIOS
                        $query = "SELECT * FROM users";
                        $select_users = pg_query($conn, $query);
                        if (pg_num_rows($select_users) > 0 ) {
                            while ($row = pg_fetch_array($select_users)) {
                                $user_id = $row['id_usuario'];
                                $username = $row['username'];
                                $user_firstname = $row['firstname'];
                                $user_lastname = $row['lastname'];
                                $user_email = $row['email'];
                                $user_role = $row['role'];
                                $user_area = $row['area'];
                                 //$user_pw = $row['password'];

                                echo "<tr>";
                                echo "<td>$user_id</td>";
                                echo "<td>$username</td>";
                                echo "<td>$user_firstname</td>";
                                echo "<td>$user_lastname</td>";
                                echo "<td>$user_email</td>";
                                echo "<td>$user_role</td>";
                                echo "<td>$user_area</td>";
                                // echo "<td>$user_pw</td>";
                                echo "<td>
                                <a class='btn btn-warning' href='#edituser' data-toggle='modal' data-user_id='".$user_id."' data-user_firstname='".$user_firstname."' data-user_lastname='".$user_lastname."' data-user_email='".$user_email."' data-user_role='".$user_role."' data-user_area='".$user_area."' ><i  class='bi bi-pencil-square'></i></a>

                                <a class='btn btn-danger' onClick=\"javascript: return confirm('¿Estás seguro de que deseas eliminar a este usuario?')\" href='users.php?delete=$user_id'><i  class='bi bi-trash'></i></a>
                                </td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                    <?php 
                }
                // ELIMINAR USUARIO
                if (isset($_GET['delete'])) {
                    $the_user_id = $_GET['delete'];
                    $query0 = "SELECT role FROM users WHERE id_usuario = '$the_user_id'";
                    $result = pg_query($conn , $query0);
                    if (pg_num_rows($result) > 0 ) {
                        $row = pg_fetch_array($result);
                        $id1 = $row['role'];
                    }
                    if ($id1 == 'superadmin') {
                        echo "<script>swal('El Perfil Super Administrador no puede ser eliminado');</script>";
                    }
                    else {

                        $query = "DELETE FROM users WHERE id_usuario = '$the_user_id'";

                        $delete_query = pg_query($conn, $query);
                        if (pg_affected_rows($delete_query) > 0 ) {
                            echo "<script>swal('Usuario borrado satisfactoriamente');
                            window.location.href= 'users.php';</script>";
                        }
                    }
                }
                // EDITAR USUARIO 
                if (isset($_POST['editaruser'])) {
                    $user_id=$_POST['user_id'];
                    $user_firstname=$_POST['user_firstname'];
                    $user_lastname=$_POST['user_lastname'];
                    $user_email=$_POST['user_email']; 
                    $user_area=$_POST['user_area'];
                    $user_role=$_POST['user_role'];

                    $editfinan = "UPDATE users SET firstname='{$user_firstname}',lastname='{$user_lastname}',email='$user_email',role='{$user_role}',area='{$user_area}' WHERE id_usuario = '{$user_id}'";

                    $resultado = pg_query($editfinan);
                    if (pg_affected_rows($resultado) > 0 ) {
                        echo 
                        '<script>
                        swal("Buen Trabajo!", "Fue editado exitosamente", "success").then(function() {
                            window.location.replace("users.php");
                            });

                            </script>';
                        }else {
                            echo '<script>swal("ERROR!", "Lo sentimos ocurrió un error al editar el archivo", "error");</script>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php 
    }
    else {
        // SI INGRESA EL USUARIO ADMINISTRADOR SOLO SE LE PERMITE CONSULTAR
        ?>
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Todos los Usuarios
                    </h1>
                    <!-- TABLA PARA MOSTRAR LOS DATOS DE LOS USUARIOS CON ID TABLA_USUARIOS PARA APLICAR EL PLUGIN DE DATATABLES -->
                    <table id="tabla_usuarios" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            //CONSULTA PARA MOSTRAR TODOS LOS USUARIOS
                            $query = "SELECT * FROM users";
                            $select_users = pg_query($conn, $query);
                            if (pg_num_rows($select_users) > 0 ) {
                                while ($row = pg_fetch_array($select_users)) {
                                    $user_id = $row['id_usuario'];
                                    $username = $row['username'];
                                    $user_firstname = $row['firstname'];
                                    $user_lastname = $row['lastname'];
                                    $user_email = $row['email'];
                                    $user_role = $row['role'];
                                    $user_area = $row['area'];
                                    echo "<tr>";
                                    echo "<td>$user_firstname</td>";
                                    echo "<td>$user_lastname</td>";
                                    echo "<td>$user_email</td>";
                                    echo "<td>$user_role</td>";
                                    echo "<td>$user_area</td>";

                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>

                        <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

}
?>
<!-- MODAL PARA EDITAR USUARIO-->
<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  action="" method="POST" class="col-md-12" >
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Nombre :</label>
                            <input type="text" required="required" id="user_firstname" class="form-control" name="user_firstname" placeholder="Nombre Usuario" >
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Apellido :</label>
                            <input type="text" required="required" id="user_lastname" class="form-control" name="user_lastname" placeholder="Apellido Usuario" >
                        </div>
                    </div>
                    <div class="form-row">
                     <div class="form-group col-md-12">
                        <label class="col-form-label">Correo :</label>
                        <input type="text" required="required" id="user_email" class="form-control" name="user_email" placeholder="Correo Usuario" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="user_status">Rol</label><br>
                        <select class="form-control" name="user_role" id="">
                            <option selected>Seleccione un Rol</option>
                            <?php
                            //CONSULTA PARA TRAER TODOS LOS ROLES
                            $query = "SELECT * FROM roles ORDER BY codigo_rol ASC";
                            $run_query = pg_query($conn, $query);
                            if (pg_num_rows($run_query) > 0) {
                                while ($row = pg_fetch_array($run_query)) {
                                    $codigo_rol = $row['codigo_rol'];
                                    $nombre_rol = $row['nombre_rol'];
                                    ?>
                                    <option value="<?php echo $nombre_rol?>" name="user_role" class="role"><?php echo $nombre_rol?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="user_status">Area</label>
                        <select class="form-control" name="user_area" id="" required>
                          <option selected>Seleccione un Area</option>
                          <?php
                          // CONSULTA PARA MOSTRAR TODAS LAS AREAS
                          $query = "SELECT * FROM area ORDER BY codigo_area ASC";
                          $run_query = pg_query($conn, $query);
                          if (pg_num_rows($run_query) > 0) {
                            while ($row = pg_fetch_array($run_query)) {
                                $nombre_area = $row['nombre_area'];
                                ?>
                                <option value="<?php echo $nombre_area?>" name="user_area" class="role"><?php echo $nombre_area?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class=" col-md-6">
                <input type="hidden" required="required" id="user_id" class="form-control" name="user_id" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" name="editaruser">Editar</button>
            </div>
        </form>
    </div>

</div>
</div>
</div> 


<script>
//FUNCION PARA CAPTURAR DATOS DE LA TABLA EN EL MODAL Y ENVIAR A EDITAR LOS CAMPOS
$('#edituser').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget); // Button that triggered the modal
          var user_id = button.data('user_id');
          var user_firstname = button.data('user_firstname'); // Extraer información de datos- * atributos
          var user_lastname = button.data('user_lastname');
          var user_email = button.data('user_email');
          
          var user_role = button.data('user_role');
          var user_area = button.data('user_area');
          //AGREGAR LOS DATOS CAPURADOS AL MODAL POR MEDIO DEL ID
          var modal = $(this);
          modal.find('.modal-body #user_id').val(user_id);
          modal.find('.modal-body #user_firstname').val(user_firstname);
          modal.find('.modal-body #user_lastname').val(user_lastname);
          modal.find('.modal-body #user_email').val(user_email);
          modal.find('.modal-body #user_role').val(user_role);
          modal.find('.modal-body #user_area').val(user_area);
      });

  </script> 
<!--   FOOTER DE LA PAGINA -->
  <?php include ('includes/adminfooter.php');?>
