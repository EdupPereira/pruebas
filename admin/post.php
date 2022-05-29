<?php include 'includes/connection.php';?>
<?php include 'includes/adminheader.php';?>
<?php include 'includes/adminnav.php';?>
<?php
if (isset($_GET['post'])) {
	$post =pg_escape_string($conn, $_GET['post']);  
}
else {
    header('location:posts.php');
}
$currentuser = $_SESSION['firstname'];
if ($_SESSION['role'] == 'superadmin') {
    $query = "SELECT * FROM posts WHERE id='$post'";
}
else {
    $query = "SELECT * FROM posts WHERE id='$post' AND author = '$currentuser'" ;
}
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

     ?>

     <div class="container-fluid">
        <div class="container">

            <div class="row">


                <div class="col-lg-8">


                    <hr>
                    <p><h2><a href="#"><?php echo $post_title; ?></a></h2></p>
                    <p><h3>Fuente <a href="#"><?php echo $post_author; ?></a></h3></p>
                    <p><span class="glyphicon glyphicon-time"></span>Publicado en <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive img-rounded" src="../allpostpics/<?php echo $post_image; ?>" alt="900 * 300">
                    <hr>
                    <p><?php echo $post_content; ?></p>

                    <hr>
                <?php } }
                else { echo"<script>alert('error');</script>"; } ?>

            </div>



        </div>
    </div>
</div>
</div>





<?php include ('includes/adminfooter.php');?>