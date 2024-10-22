<?php

class TipoLocales{
    private int $codLocal;
    private int $descripcion;

    public function __construct(int $codLocal, int $descripcion){
        $this->codLocal = $codLocal;
        $this->descripcion = $descripcion;
    }

    public function getCodLocal(): int{
        return $this->codLocal;
    }

    public function setCodLocal(int $codLocal): void{
        $this->codLocal = $codLocal;
    }

    public function getDescripcion(): int{
        return $this->descripcion;
    }

    public function setDescripcion(int $descripcion): void{
        $this->descripcion = $descripcion;
    }





}