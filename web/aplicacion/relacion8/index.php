<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");

// Controlador
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 8",
        "ENLACE" => ""
    ]
];

// Dibuja la plantilla de la vista
inicioCabecera("Sesiones y Seguridad");
cabecera();
finCabecera();

inicioCuerpo("Relacion 8: Sesiones y Seguridad", $barra);
cuerpo(); // Llamo a la vista
finCuerpo();

// **********************************************************
function cabecera(){}

// Vista
function cuerpo(){
?>
<ul class="menuOpciones">
    <li><a href="/aplicacion/texto/verTextos.php">Textos</a></li>
    <li><a href="/aplicacion/personalizar/index.php">Pagina Color</a></li>
    <li><a href="/aplicacion/personalizar/personalizar.php">Personalizar</a></li>
</ul>
<main class="contenidoPrincipal">

</main>
<?php
}
