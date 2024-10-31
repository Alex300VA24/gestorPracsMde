<?php
class Directiva{
    private int $codDirectiva;
    private int $codSocio;
    private int $codCargo;
    private int $codEstado;

    public function getCodDirectiva(): int{
        return $this->codDirectiva;
    }

    public function setCodDirectiva(int $codDirectiva): void{
        $this->codDirectiva = $codDirectiva;
    }

    public function getCodSocio(): int{
        return $this->codSocio;
    }

    public function setCodSocio(int $codSocio): void{
        $this->codSocio = $codSocio;
    }

    public function getCodCargo(): int{
        return $this->codCargo;
    }

    public function setCodCargo(int $codCargo): void{
        $this->codCargo = $codCargo;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

}
