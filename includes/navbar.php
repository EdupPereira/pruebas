<?php session_start();?>
 
<nav class="navbar fixed-top navbar-expand-lg navbar-light col-sm-12 col-xs-12" style="background-color: #fff;">
  <div class="container-fluid ps-4">
    <a class="navbar-brand ps-4" href="#"><img src="image/logotipo.png" alt="" width="150" height="80" class="d-inline-block align-text-top"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse  navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-4 mb-lg-0 ps-5">
        <li class="nav-item ps-3 pt-3">
          <a class="enlace  active" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item dropdown ps-3 pt-3">
          <a class="enlace dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            EDUP
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="enlace dropdown-item" href="edup.php">¿Que es EDUP?</a></li>

            <li><a class="enlace dropdown-item" href="#">Equipo Edup</a></li>
            <li><a class="enlace dropdown-item" href="#">Lineas de Negocios</a></li>
          </ul>
        </li>
        <li class="nav-item ps-3 pt-3">
          <a class="enlace" href="transparencia.php">Transparencia</a>
        </li>
        <li class="nav-item ps-3 pt-3">
          <a class="enlace" href="noticias.php">Noticias</a>
        </li>
 <!--        <li class="nav-item ps-3 pt-3">
          <a class="enlace" href="sst.php">SST</a>
        </li> -->
        <li class="nav-item ps-3 pt-3">
          <a class="enlace" href="pqrsfd.php">PQRSFD</a>
        </li>
        
        <li class="nav-item ps-3 pt-3">
          <a class="enlace" href="contactanos.php">Contáctanos</a>
        </li>
        <li class="nav-item ps-3 pt-3">
          <a href=""><i class="ps-3 fa fa-facebook fa-lg" style="color:#F1BF29;"></i></a>
          <a href="https://www.instagram.com/juancamilo.jimenezg/" target="_blank"><i class="ps-3 fa fa-instagram fa-lg" style="color:#F1BF29;"></i></a>
          <a href=""><i class="ps-3 fa fa-youtube fa-lg" style="color:#F1BF29;"></i></a>
        </li>

        <li class="nav-item ps-5 pt-3">
          <div  id="google_translate_element" class="nav-item  d-flex"></div>
        </li>
        <li class="nav-item ps-3">
          <a class="navbar-brand " href="http://www.pereira.gov.co/"><img src="image/pereira.png" alt="" width="130" height="60" class="d-inline-block align-text-top"></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Botones --> 
<div class="btn-flotante " role="toolbar" aria-label="Botones">
 
  <a href="https://centroderelevo.gov.co/" target="_blank"><button type="button" class="aumentar btn btn-warning mr-1" title="Centro de Relevo"><i class="fa fa-sign-language" style="color:#FFFFFF; font-size:20px;"></i></button><br></a>
  <button type="button" class="aumentar btn btn-warning mr-1" title="Aumentar Letra"><i class="bi bi-zoom-in" style="color:#FFFFFF; font-size:20px;"></i></button><br>
  <button type="button" class="disminuir btn btn-warning mr-1" title="Aumentar Disminuir"><i class="bi bi-zoom-out" style="color:#FFFFFF; font-size:20px;"></i></button><br>
  <button type="button" class="restablecer btn btn-warning mr-1" title="Restablecer Letra"><i class="bi bi-arrow-repeat" style="color:#FFFFFF; font-size:20px;"></i></button><br>
  <button type="button" class="mostrar btn verde mr-1" title="Mostrar Opciones"><i class="bi bi-eye" style="color:#FFFFFF; font-size:20px;"></i></button>
  <button type="button" class="ocultar btn azul mr-1" title="Ocultar Opciones"><i class="bi bi-eye-slash" style="color:#FFFFFF; font-size:20px;"></i></button><br>
  <!-- Tamaño actual del texto (fuente) --> 
</div>

<div class="btn-fab">
  <nav class="fab-menu">
    <a href="transparencia.php"></a><button class="fab-menu__item">Transparencia</button>
    <a href="pqrsfd.php"></a><button class="fab-menu__item">PQRSDF</button>
    <a href="noticias.php"></a><button class="fab-menu__item">Noticias</button>
  </nav>
  <button class="btn-fab__action" id="fab">
    <i class="bi bi-chat-square-text"></i>
  </button>
</div>

<script type="text/javascript">
  function googleTranslateElementInit(){
    new google.translate.TranslateElement({pageLanguage:'es',layout:google.translate.TranslateElement.InlineLayout.SIMPLE},'google_translate_element');
  }

  var fab = document.getElementById('fab');
  var fabWrapper = document.getElementsByClassName('btn-fab');
  fab.addEventListener('click', function(){
    fabWrapper[0].classList.toggle('open');
  })
</script>


