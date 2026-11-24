<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=> "Inicio",
        "ENLACE" =>"/index.php"//, "ADICIONAL"=>">>"
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
    <ul class="menuOpciones">
        <li><a href="/aplicacion/principal/pruebas.php">Pruebas</a></li>
        <li><a href="/aplicacion/relacion8/index.php">Relacion 8</a></li>
    </ul>
<?php
}