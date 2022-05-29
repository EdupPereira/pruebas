$( document ).ready(function() {
  $(".mostrar").hide();
 $("#form-anonimo").hide();
 $("#form-cuidadano").hide();
 $("#consulanonimo").hide();
 
 
    if (window.history.replaceState) { // verificamos disponibilidad
      window.history.replaceState(null, null, window.location.href);
    }
  
    $('.customer-logos').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1500,
      arrows: false,
      dots: false,
      pauseOnHover: false,
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 4
        }
      }, {
        breakpoint: 520,
        settings: {
          slidesToShow: 3
        }
      }]
    });
    
    $(".ocultar").on('click',ocultar); 
    $(".mostrar").on('click',mostrar);  
  //BOTONES PARA MOSTRAR FORMULARIO PQRSD
  
  $(".cuidadano").on('click',cuidadano); 
  $(".reservada").on('click',reservada); 
  $(".anonimo").on('click',anonimo); 
  $("#conllegada").on('click', conllegada); 
  $("#mostraranonimo").on('click',mostraranonimo);
});
//OCULTAR BOTONES DE ACCESIBILIDAD
function ocultar(){
  $(".ocultar").hide();
  $(".mostrar").show();
  $(".aumentar").hide();
  $(".disminuir").hide();
  $(".restablecer").hide();
}
//MOSTRAR BOTONES DE ACCESIBILIDAD
function mostrar(){
  $(".mostrar").hide();
  $(".ocultar").show();
  $(".aumentar").show();
  $(".disminuir").show();
  $(".restablecer").show();
}

//BOTONES PQRSD
function cuidadano(){
  swal("Atención","Autorización de datos personales - Habeas Data De conformidad con lo dispuesto en la Ley 1581 de 2012, su Decreto Reglamentario 1377 de 2013 y el Acuerdo No. 013 de 2019, AUTORIZO de manera libre y voluntaria, conforme con la Política de Tratamiento de Datos Personales, a la Empresa de Desarrollo Urbano de Pereira – EDUP, como responsable para recolectar, usar y tratar conjunta o separadamente mis datos, que han sido suministrados y que se han incorporado en distintas bases o bancos de datos de todo tipo.En este sentido, la EDUP queda autorizada de manera expresa e inequívoca para mantener y manejar toda mi información personal y profesional para los fines que se encuentra legal y reglamentariamente facultado.Sin perjuicio de lo anterior, los referidos datos no podrán ser distribuidos, comercializados, compartidos, suministrados o intercambiados con terceros, y en general, realizar actividades en las cuales se vea comprometida la confidencialidad y protección de la información recolectada, y podré en cualquier momento solicitar que la información sea modificada, actualizada o retirada de las bases de datos de la EDUP","warning");
  $("#form-anonimo").hide("slack");
  $("#form-cuidadano").show("slack");

}
function reservada(){
  $("#form-cuidadano").hide("slack");
  $("#form-anonimo").hide("slack");
}

function anonimo(){
  $("#form-cuidadano").hide("slack");
  $("#form-anonimo").show("slack");
}

// Defino un tamaño de letra inicial de 16px
function tamañoLetra() {
  size = $(".mitexto" ).css("font-size");
  size = parseInt(size, 10);
  $( ".tamaño-actual" ).text(size);
}

// Obtengo el tamaño de letra inicial de 16px 
tamañoLetra();

// Función para disminuir el tamaño del texto (fuente) 
$(".disminuir").on("click", function() {
  if ((size - 2) >= 13) {
    $(".mitexto").css("font-size", "-=2");
    $(".tamaño-actual").text(size -= 1);
  }
});

// Función para aumentar el tamaño del texto (fuente) 
$(".aumentar").on("click", function() { 
  if ((size + 2) <= 47) {
    $(".mitexto").css("font-size", "+=2");
    $(".tamaño-actual").text(size += 1);
  }
});

// Función para restablecer el tamaño del texto (fuente) al tamaño inicial 
$(".restablecer").on("click", function() {
  $(".mitexto").css("font-size", "initial");
  size = $(".mitexto" ).css("font-size");
  size = parseInt(size, 10);
  $( ".tamaño-actual" ).text(size);
}); 

function conllegada(){
  var identificacion= $("#identificacion").val();
  if(identificacion==0){
    swal("¡Atención!", "Lo sentimos debes ingresar el # de identificación ", "info");
  }else{
    var eljson= {'identificacion':identificacion};
    $.ajax({
     type:'POST',
     url:'php/conllegada.php',
     data: eljson,
     success: function (gato) {
       $("#resultado").html(gato);         
     }
   });
  }
}

function mostraranonimo(){
  $(".formllegada").hide("slack");
  $("#consulanonimo").show("slack");
}