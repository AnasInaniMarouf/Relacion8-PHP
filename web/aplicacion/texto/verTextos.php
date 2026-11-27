<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../clases/RegistroTexto.php");

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
        "TEXTO" => "Textos",
        "ENLACE" => ""
    ]
];

if(!isset($_SESSION["RegistroTextos"])) {
    $_SESSION["RegistroTextos"] = [];
}

$textos = $_SESSION["RegistroTextos"];

if(isset($_POST["registrar"])) {
    $texto = $_POST["textoRegistro"];

    if($texto != "") {
        $_SESSION["RegistroTextos"][] = registraTexto($texto);
        $textos = $_SESSION["RegistroTextos"];
    }
}

// Dibuja la plantilla de la vista
inicioCabecera("Practica 8");
cabecera();
finCabecera();

inicioCuerpo("Color", $barra);
cuerpo($textos); // Llamo a la vista
finCuerpo();

// **********************************************************
function cabecera(){}

// Vista
function cuerpo(array $textos){
?>
<main class="contenidoPrincipal">
<?php
formulario($textos);
?>
</main>
<?php
}

function formulario(array $textos) {
?>
    <form action="verTextos.php" method="post">
        <input type="text" name="textoRegistro" id="" placeholder="Introduzca un texto">
        <button type="submit" name="registrar">Registrar</button>
    </form>
    <h3>Textos Registrados</h3>
    <textarea name="" cols="40" rows="7" placeholder="Los registros de textos apareceran aqui"><?php 
        foreach($textos as $registroTexto) {
            echo $registroTexto;
        }
    ?></textarea>
<?php
}

function registraTexto(string $texto): RegistroTexto {
    return new RegistroTexto($texto);
}