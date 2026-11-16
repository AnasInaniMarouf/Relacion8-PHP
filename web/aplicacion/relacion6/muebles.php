
<?php

function crearMuebles(): array {
    $muebles = [];

    // Mueble 1: Reciclado
    $caracs1 = new Caracteristicas();
    $caracs1->Material = "Plástico";
    $caracs1->Color = "Verde";

    $muebles[1] = new MuebleReciclado(
        "Mesa reciclada",
        precio: 45,
        caracs: $caracs1,
        porcentajeReciclado: 80
    );


    // Mueble 2: Tradicional
    $caracs2 = new Caracteristicas();
    $caracs2->Material = "Madera";
    $caracs2->Color = "Marrón";

    $muebles[2] = new MuebleTradicional(
        "Silla clásica",
        precio: 60,
        caracs: $caracs2,
        peso: 15,
        serie: "S01"
    );


    // Mueble 3: Reciclado
    $caracs3 = new Caracteristicas();
    $caracs3->Material = "Cartón reciclado";
    $caracs3->Color = "Blanco";

    $muebles[3] = new MuebleReciclado(
        "Estantería ecológica",
        precio: 75,
        caracs: $caracs3,
        porcentajeReciclado: 90
    );


    // Mueble 4: Tradicional
    $caracs4 = new Caracteristicas();
    $caracs4->Material = "Roble";
    $caracs4->Color = "Natural";

    $muebles[4] = new MuebleTradicional(
        "Armario clásico",
        precio: 250,
        caracs: $caracs4,
        peso: 40,
        serie: "S02"
    );


    // Mueble 5: Reciclado
    $caracs5 = new Caracteristicas();
    $caracs5->Material = "Madera recuperada";
    $caracs5->Color = "Negro";

    $muebles[5] = new MuebleReciclado(
        "Banco reciclado",
        precio: 90,
        caracs: $caracs5,
        porcentajeReciclado: 70
    );

    return $muebles;
}