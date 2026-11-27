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
        "TEXTO" => "Pagina Color",
        "ENLACE" => ""
    ]
];

//si esta creada se aumenta el valor en 1
if (isset($_COOKIE["contadorAccesoPagina"])) {
    setcookie("contadorAccesoPagina", ($_COOKIE["contadorAccesoPagina"]+1), time() + 3600);
} else {    //si no esta creada la cookie se crea
    setcookie("contadorAccesoPagina", 2, time() + 3600);    //time() + 3600 para que expire en una hora la cookie
}

$cont = $_COOKIE["contadorAccesoPagina"] ?? 1;

// Dibuja la plantilla de la vista
inicioCabecera("Practica 8");
cabecera();
finCabecera();

inicioCuerpo("Color", $barra);
cuerpo($cont); // Llamo a la vista
finCuerpo();

// **********************************************************
function cabecera(){}

// Vista
function cuerpo(int $cont){
?>
<main class="contenidoPrincipal">
<?php
    echo "Numero de veces que se ha accedido a la pagina: " . $cont;
?>
</main>
<?php
}