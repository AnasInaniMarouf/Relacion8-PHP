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
        "ENLACE" => "/aplicacion/relacion8/index.php"
    ],
    [
        "TEXTO" => "Personalizar",
        "ENLACE" => ""
    ]
];

// Dibuja la plantilla de la vista
inicioCabecera("Personalizar");
cabecera();
finCabecera();

inicioCuerpo("Personalizar", $barra);
cuerpo(); // Llamo a la vista
finCuerpo();

// **********************************************************
function cabecera(){}

// Vista
function cuerpo(){
}

function colores() {
?>
    
<?php
}