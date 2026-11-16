
<?php

include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/muebles.php");

// Controlador
$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 6",
        "ENLACE" => ""
    ]
];

// Dibuja la plantilla de la vista
inicioCabecera("Tienda");
cabecera();
finCabecera();

inicioCuerpo("TIENDA", $barra);
cuerpo(); // Llamo a la vista
finCuerpo();

// **********************************************************
function cabecera(){}

// Vista
function cuerpo(){
    muestraTabla(crearMuebles());
}

function muestraTabla(array $muebles) {
?>    
<main class="contenidoPrincipal">
    <h1>TIENDA DE MUEBLES</h1>
    <h2>Listado de muebles</h2>

    <table class="tabla">
        <tr>
            <th>Índice</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Fabricante</th>
            <th>País</th>
            <th>Precio</th>
        </tr>

        <?php foreach ($muebles as $indice => $mueble): ?>
            <tr>
                <td><?= $indice ?></td>
                <td><?= get_class($mueble) ?></td>
                <td><?= $mueble->getNombre() ?></td>
                <td><?= $mueble->getFabricante() ?></td>
                <td><?= $mueble->getPais() ?></td>
                <td><?= $mueble->getPrecio() ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Seleccionar mueble</h2>
    <form action="index.php" method="POST">
        <select name="indice" required>
            <?php foreach ($muebles as $indice => $mueble): ?>

                <option value="<?= $indice ?>">
                    <?= $indice . " - " . $mueble->getNombre() ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="accion" value="mostrar">
            Mostrar Mueble
        </button>
        <button type="submit"
                name="accion"
                value="modificar"
                formaction="modificar.php"
                formtarget="_blank">
            Modificar Mueble
        </button>
    </form>

    <?php
    //mostrar el mueble seleccionado
    if (isset($_POST["accion"]) && $_POST["accion"] == "mostrar" &&isset($_POST["indice"])) {
        $indice = (int) $_POST["indice"];

        if (isset($muebles[$indice])) {
            $mueble = $muebles[$indice];
    ?>
            <h2>Datos del mueble seleccionado</h2>
            <p>
                <strong>Tipo:</strong>
                <?= get_class($mueble) ?>
            </p>
            <p>
                <strong>Nombre:</strong>
                <?= $mueble->getNombre() ?>
            </p>
            <p>
                <strong>Fabricante:</strong>
                <?= $mueble->getFabricante() ?>
            </p>
            <p>
                <strong>País:</strong>
                <?= $mueble->getPais() ?>
            </p>
            <p>
                <strong>Año:</strong>
                <?= $mueble->getAnio() ?>
            </p>
            <p>
                <strong>Fecha inicio venta:</strong>
                <?= $mueble->getFechaIniVenta() ?>
            </p>
            <p>
                <strong>Fecha fin venta:</strong>
                <?php
                $fechaFin = $mueble->getFechaFinVenta();
                echo $fechaFin instanceof DateTime
                    ? $fechaFin->format("d/m/Y")
                    : $fechaFin;
                ?>
            </p>
            <p>
                <strong>Precio:</strong>
                <?= $mueble->getPrecio() ?> €
            </p>

            <h3>Propiedades adicionales</h3>
            <?php
            foreach ($mueble->damePropiedadesAdicionales() as $nombre => $valor) {
                echo "<p><strong>" . (string)$nombre .
                    ":</strong> " . (string)$valor . "</p>";
            }?>

            <h3>Características adicionales</h3>
            <?php

            foreach ($mueble->getCaracteristicas() as $clave => $valor) {
                echo "<p><strong>" . (string)$clave .
                        ":</strong> " . (string)$valor . "</p>";
            }?>
    <?php
        } else {
            echo "<p>El mueble seleccionado no existe</p>";
        }
    }
    ?>
</main>
<?php
}