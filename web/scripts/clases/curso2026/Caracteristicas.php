<?php

class Caracteristicas implements Iterator {

    private array $_caracteristicas = [];
    private int $_indice = 0;
    private bool $_esUltima = false;

    public function __toString() {
        $cadena = "";

        foreach ($this -> _caracteristicas as $clave => $valor) {
            $cadena .= $clave . ":" . $valor . ";";
        }

        return $cadena;
    }

    /*Metodos de la interfaz Iterator*/

    /**
     * Funcion del iterator que devuelve la clave del elemento actual,
     * aunque esta cambiado para que devuelva el ultimo indice del array
     * menos el indice de la clase, asi simularia el orden inverso
     *
     * @return mixed
     */
    public function key(): mixed {
        return array_keys($this -> _caracteristicas)[count($this -> _caracteristicas) - 1 - $this -> _indice];
    }

    /**
     * Funcion del iterator que devuelve el elemento actual
     *
     * @return mixed caracteristica
     */
    public function current(): mixed {
        if($this ->_indice == count($this->_caracteristicas) - 1) return $this->_caracteristicas["numero_serie"];  //asi sera el primero que se devuelva (como esta en orden inverso el foreach pues se coge la ultima posicion)
        return $this -> _caracteristicas[$this -> key()];   //tenia puesto el indice de la clase en vez de key() pero claro como el orden es inverso no me devolvia el valor correcto
    }

    /**
     * Funcion del iterator que se mueve aumenta el indice en 1
     *
     * @return void
     */
    public function next(): void {
        $this -> _indice++;
    }

    /**
     * Funcion del iterator que vuelve al principio
     *
     * @return void
     */
    public function rewind(): void {
        $this -> _indice = 0;
    }

    /**
     * Funcion del iterator que comprueba si la posicion actual es valida
     *
     * @return boolean
     */
    public function valid(): bool {
        return $this->_indice < count($this->_caracteristicas);
    }

    /*Metodos para la creacion de las caracteristicas de forma dinamica*/
    public function __get(string $nombre): mixed {
        if($nombre == "numero_serie") {     //si se quiere acceder a numero_serie se devuelve un array con 15 digitos
            $secuencia = "";    //en vez de un array lo pongo como string para que asi esten todos pegados al querer mostrarlo

            for($i = 0; $i < 15; $i++) {
                $secuencia[$i] = rand(0, 9);
            }

            return $secuencia;
        }

        //si no devuelve la caracteristica normal
        return $this -> _caracteristicas[$nombre];
    }

    public function __set(string $nombre, mixed $valor): void {
        //si se quiere guardar o cambiar el valor de numero_serie no se hace nada
        if(!$nombre == "numero_serie") {

            //si existe, se puede modificar
            if(array_key_exists($nombre, $this -> _caracteristicas)) {
                $this->_caracteristicas[$nombre] = $valor;
            }
                
            //si esUltima es true, ya no se permite añadir mas valores, pero si modificar (por eso esta debajo de la condicion anterior)
            if ($this->_esUltima) {
                throw new Exception("No se pueden crear más características.");
            }

            //si es ULTIMA, se cambia la variable booleana para que no se puedan añadir valores
            if ($nombre == "ULTIMA") {
                $this->_esUltima = true;

            } else {    //si no, se añade o bien se medifica si ya existe
                $this->_caracteristicas[$nombre] = $valor;
            }
        }

    }

    public function __isset(string $nombre): bool {
        return (isset($this -> _caracteristicas[$nombre]));
    }
}