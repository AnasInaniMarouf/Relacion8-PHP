<?php
enum MATERIALES: int{
    case MADERA = 5;
    case HIERRO = 10;
    case PLASTICO = 15;
    case ALUMINIO = 20;

    /**
     * Funcion que devuelve el nombre del caso concreto
     *
     * @return string
     */
    public function getMaterialDescripcion(): string {
        return $this -> name;
    }

    /**
     * Funcion que devuelve el valor del caso concreto
     *
     * @return integer
     */
    public function valor(): int {
        return $this -> value;
    }

    /**
     * Funcion estatica que busca en todos los materiales por valor, si lo encuentra lo devuelve,
     * si no devuelve null. Es estatica para que asi me permita asignarle un valor sin tener que
     * un material antes
     *
     * @return MATERIALES
     */
    public static function buscaMaterialPorValor(int $valor): MATERIALES | null {

        foreach (MATERIALES::cases() as $material) {
            if($material -> valor() == $valor) return $material;    //si ambos valores coinciden devuelve el Material
        }

        return null;    //si llega hasta aqui esque no se ha encontrado ningun material
    }
}