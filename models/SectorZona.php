<?php

class SectorZona{
    private int $codSectorZona;
    private int $codZona;
    private string $nombreZona;
    private int $codSector;
    private string $nombreSector;

    public function __construct(int $codSectorZona, int $codZona, string $nombreZona, int $codSector, string $nombreSector){
        $this->codSectorZona = $codSectorZona;
        $this->codZona = $codZona;
        $this->nombreZona = $nombreZona;
        $this->codSector = $codSector;
        $this->nombreSector = $nombreSector;
    }

    public function getCodSectorZona(): int{
        return $this->codSectorZona;
    }

    public function setCodSectorZona(int $codSectorZona): void{
        $this->codSectorZona = $codSectorZona;
    }

    public function getCodZona(): int{
        return $this->codZona;
    }

    public function setCodZona(int $codZona): void{
        $this->codZona = $codZona;
    }

    public function getNombreZona(): string{
        return $this->nombreZona;
    }

    public function setNombreZona(string $nombreZona): void{
        $this->nombreZona = $nombreZona;
    }

    public function getCodSector(): int{
        return $this->codSector;
    }

    public function setCodSector(int $codSector): void{
        $this->codSector = $codSector;
    }

    public function getNombreSector(): string{
        return $this->nombreSector;
    }

    public function setNombreSector(string $nombreSector): void{
        $this->nombreSector = $nombreSector;
    }

    public function listarZonasPorSector(){

    }


}