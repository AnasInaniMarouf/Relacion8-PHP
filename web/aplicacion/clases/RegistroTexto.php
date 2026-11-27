<?php

class RegistroTexto {
    private string $_texto;
    private DateTime $_hora;

    public function __construct(string $texto) {
        $this->_texto = $texto;
        $_hora = new DateTime("now");
    }

    public function __toString(): string {
        return $this->_texto . " (" . $this->_hora->format("H:M:S") . ")";
    }

    public function getTexto(): string {
        return $this->_texto;
    }

    public function getHora(): DateTime {
        return $this->_hora;
    }
}