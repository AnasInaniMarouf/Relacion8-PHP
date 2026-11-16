<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/muebles.php");

$barra = [
    [
        "TEXTO" => "Inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "Modificar",
        "ENLACE" => ""
    ]
];

//controlador
//se crean los muebles
$muebles = crearMuebles();

//recojo el indice enviado por el formulario
$indice = 0;
if (isset($_POST["indice"])) {
    $indice = intval($_POST["indice"]);
}

$mueble = null;
if (isset($muebles[$indice])) {
    $mueble = $muebles[$indice];
}

$errores = [];
$datos = [];
$guardado = false;
$tipo = "";

if ($mueble != null) {
    $tipo = get_class($mueble);
    $caracs = $mueble->getCaracteristicas();

    //datos iniciales segun el tipo de mueble
    $datos = [
        "nombre" => $mueble->getNombre(),
        "fabricante" => $mueble->getFabricante(),
        "pais" => $mueble->getPais(),
        "anio" => $mueble->getAnio(),
        "precio" => $mueble->getPrecio(),
        "material" => isset($caracs->Material) ? $caracs->Material : "",
        "color" => isset($caracs->Color) ? $caracs->Color : ""
    ];

    if ($tipo == "MuebleReciclado") {
        $datos["porcentaje"] = $mueble->getPorcentajeReciclado();
    } else {
        $datos["peso"] = $mueble->getPeso();
        $datos["serie"] = $mueble->getSerie();
    }

    //comprobar si se ha dado a guardar
    if (isset($_POST["guardar"])) {

        //sustituyo los datos iniciales por los enviados
        foreach ($datos as $clave => $valor) {
            if (isset($_POST[$clave])) {
                $datos[$clave] = trim($_POST[$clave]);
            }
        }

        //instancia auxiliar del mismo tipo que el mueble
        if ($tipo == "MuebleReciclado") {
            $aux = new MuebleReciclado("auxiliar");
        } else {
            $aux = new MuebleTradicional("auxiliar");
        }

        //parte 1: se valida con la instancia auxiliar llamando a los set
        if (!$aux->setNombre($datos["nombre"])) {
            $errores["nombre"][] = "El nombre no puede estar vacio ni tener mas de 40 caracteres";
        }

        if (!$aux->setPrecio(floatval($datos["precio"]))) {
            $errores["precio"][] = "El precio debe ser como minimo 30";
        }

        if ($tipo == "MuebleReciclado") {
            if (!$aux->setPorcentajeReciclado(intval($datos["porcentaje"]))) {
                $errores["porcentaje"][] = "El porcentaje reciclado no es valido";
            }
        } else {
            if (!$aux->setPeso(floatval($datos["peso"]))) {
                $errores["peso"][] = "El peso debe estar entre 15 y 300";
            }
            if (!$aux->setSerie($datos["serie"])) {
                $errores["serie"][] = "La serie no puede estar vacia";
            }
        }

        //parte 2: se valida directamente con condiciones
        if ($datos["fabricante"] == "") {
            $errores["fabricante"][] = "Debe indicarse un fabricante";
        }

        if ($datos["pais"] == "" || mb_strlen($datos["pais"]) > 20) {
            $errores["pais"][] = "El pais no puede estar vacio ni tener mas de 20 caracteres";
        }

        $anio = intval($datos["anio"]);
        if ($anio < 2020 || $anio > intval(date("Y"))) {
            $errores["anio"][] = "El anio debe estar entre 2020 y " . date("Y");
        }

        if ($datos["material"] == "") {
            $errores["material"][] = "Debe indicarse un material";
        }

        if ($datos["color"] == "") {
            $errores["color"][] = "Debe indicarse un color";
        }

        //si no hay errores se actualiza el mueble
        if (!$errores) {
            $mueble->setNombre($datos["nombre"]);
            $mueble->setFabricante($datos["fabricante"]);
            $mueble->setPais($datos["pais"]);
            $mueble->setAnio($anio);
            $mueble->setPrecio(floatval($datos["precio"]));

            if ($tipo == "MuebleReciclado") {
                $mueble->setPorcentajeReciclado(intval($datos["porcentaje"]));
            } else {
                $mueble->setPeso(floatval($datos["peso"]));
                $mueble->setSerie($datos["serie"]);
            }

            $caracs->Material = $datos["material"];
            $caracs->Color = $datos["color"];

            $muebles[$indice] = $mueble;
            $guardado = true;
        }
    }
}

//dibuja la plantilla de la vista
inicioCabecera("Modificar mueble");
cabecera();
finCabecera();

inicioCuerpo("MODIFICAR MUEBLE", $barra);
cuerpo($mueble, $indice, $tipo, $datos, $errores, $guardado);
finCuerpo();

// **********************************************************
//vista
function cabecera() {}

//vista
function cuerpo(object $mueble, int $indice, string $tipo, array $datos, array $errores, bool $guardado) {
    echo "<main class='contenidoPrincipal'>";

    if ($mueble == null) {
        echo "<p>El mueble seleccionado no existe</p>";
        echo "<a href='index.php'>Ir a Index.php</a>";
    } elseif ($guardado) {
        resumen($mueble, $indice);
    } else {
        formulario($indice, $tipo, $datos, $errores);
    }

    echo "</main>";
}

function formulario(int $indice, string $tipo, array $datos, array $errores) {
    if ($errores) { //mostrar los errores
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error) {
                echo "$clave => $error<br>" . PHP_EOL;
            }
        }
        echo "</div>";
    }
?>
    <h2>Modificar mueble <?php echo $indice . " (" . $tipo . ")"; ?></h2>
    <form action="modificar.php" method="post">
        <input type="hidden" name="indice" value="<?php echo $indice; ?>">

        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $datos["nombre"]; ?>"><br>

        <label for="fabricante">Fabricante: </label>
        <input type="text" name="fabricante" id="fabricante" value="<?php echo $datos["fabricante"]; ?>"><br>

        <label for="pais">Pais: </label>
        <input type="text" name="pais" id="pais" value="<?php echo $datos["pais"]; ?>"><br>

        <label for="anio">Anio: </label>
        <input type="text" name="anio" id="anio" value="<?php echo $datos["anio"]; ?>"><br>

        <label for="precio">Precio: </label>
        <input type="text" name="precio" id="precio" value="<?php echo $datos["precio"]; ?>"><br>

        <label for="material">Material: </label>
        <input type="text" name="material" id="material" value="<?php echo $datos["material"]; ?>"><br>

        <label for="color">Color: </label>
        <input type="text" name="color" id="color" value="<?php echo $datos["color"]; ?>"><br>

        <?php if ($tipo == "MuebleReciclado") { ?>
            <label for="porcentaje">Porcentaje reciclado: </label>
            <input type="text" name="porcentaje" id="porcentaje" value="<?php echo $datos["porcentaje"]; ?>"><br>
        <?php } else { ?>
            <label for="peso">Peso: </label>
            <input type="text" name="peso" id="peso" value="<?php echo $datos["peso"]; ?>"><br>

            <label for="serie">Serie: </label>
            <input type="text" name="serie" id="serie" value="<?php echo $datos["serie"]; ?>"><br>
        <?php } ?>

        <input type="submit" class="boton" value="Guardar" name="guardar">
    </form>
    <br>
    <a href="index.php">Ir a Index.php</a>
<?php
}

function resumen(object $mueble, int $indice) {
?>
    <h2>Mueble <?php echo $indice; ?> modificado correctamente</h2>
    <p><strong>Tipo:</strong> <?php echo get_class($mueble); ?></p>
    <p><strong>Nombre:</strong> <?php echo $mueble->getNombre(); ?></p>
    <p><strong>Fabricante:</strong> <?php echo $mueble->getFabricante(); ?></p>
    <p><strong>Pais:</strong> <?php echo $mueble->getPais(); ?></p>
    <p><strong>Anio:</strong> <?php echo $mueble->getAnio(); ?></p>
    <p><strong>Precio:</strong> <?php echo $mueble->getPrecio(); ?> €</p>

    <h3>Propiedades adicionales</h3>
    <?php
    foreach ($mueble->damePropiedadesAdicionales() as $nombre => $valor) {
        echo "<p><strong>" . $nombre . ":</strong> " . $valor . "</p>";
    }
    ?>

    <h3>Caracteristicas</h3>
    <?php
    foreach ($mueble->getCaracteristicas() as $clave => $valor) {
        echo "<p><strong>" . $clave . ":</strong> " . $valor . "</p>";
    }
    ?>

    <br>
    <a href="index.php">Ir a Index.php</a>
<?php
}