<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"
    ],
    [
        "TEXTO" => "Pruebas",
        "ENLACE" => ""
    ]
];

//dibuja la plantilla de la vista
inicioCabecera("Tienda");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barra);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera()
{}
//vista
function cuerpo()
{
?>
<main class="contenidoPrincipal">
<?php

//Caracteristicas para el objeto muebleReciclado
$caracteristicasReciclado = new Caracteristicas();
$caracteristicasReciclado->Material = "Plástico";
$caracteristicasReciclado->PorcentajeReciclado = 80;

//Caracteristicas para el objeto muebleTradicional
$caracteristicasTradicional = new Caracteristicas();
$caracteristicasTradicional->Material = "Madera";
$caracteristicasTradicional->Peso = 20;
$caracteristicasTradicional->Serie = "S02";

//Creacion de objetos Mueble
$muebleReciclado = new MuebleReciclado("Mesa reciclada", caracs: $caracteristicasReciclado);
$muebleTradicional = new MuebleTradicional("Mesa tradicional", caracs: $caracteristicasTradicional);

//MuebleReciclado
echo "<h3>Prueba de MuebleReciclado</h3>";
echo $muebleReciclado;

//MuebleTradicional
echo "<h3>Prueba de MuebleTradicional</h3>";
echo $muebleTradicional;

?>
</main>
<?php
}

