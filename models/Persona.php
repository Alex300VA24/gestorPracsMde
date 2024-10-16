<?php

class Persona{

    private int $codPersona;
    private string $nombres;
    private string $apellidoPaterno;
    private string $apellidoMaterno;
    private string $dni;
    private string $sexo;
    private string $telefono;
    private string $celular;
    private string $fechaNacimiento;
    private string $aniosNacido;
    private string $mesesNacido;
    private string $diasNacido;
    private int $codSectorZona;
    private string $desSectorZona;
    private string $direccion;
    private int $numeroFinca;
    private int $codEstado;

    public function getCodPersona(): int{
        return $this->codPersona;
    }

    public function setCodPersona(int $codPersona): void{
        $this->codPersona = $codPersona;
    }

    public function getNombres(): string{
        return $this->nombres;
    }

    public function setNombres(string $nombres): void{
        $this->nombres = $nombres;
    }

    public function getApellidoPaterno(): string{
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno(string $apellidoPaterno): void{
        $this->apellidoPaterno = $apellidoPaterno;
    }

    public function getApellidoMaterno(): string{
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno(string $apellidoMaterno): void{
        $this->apellidoMaterno = $apellidoMaterno;
    }

    public function getDni(): string{
        return $this->dni;
    }

    public function setDni(string $dni): void{
        $this->dni = $dni;
    }

    public function getSexo(): string{
        return $this->sexo;
    }

    public function setSexo(string $sexo): void{
        $this->sexo = $sexo;
    }

    public function getTelefono(): string{
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void{
        $this->telefono = $telefono;
    }

    public function getCelular(): string{
        return $this->celular;
    }

    public function setCelular(string $celular): void{
        $this->celular = $celular;
    }

    public function getFechaNacimiento(): string{
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(string $fechaNacimiento): void{
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getAniosNacido(): string{
        return $this->aniosNacido;
    }

    public function setAniosNacido(string $aniosNacido): void{
        $this->aniosNacido = $aniosNacido;
    }

    public function getMesesNacido(): string{
        return $this->mesesNacido;
    }

    public function setMesesNacido(string $mesesNacido): void{
        $this->mesesNacido = $mesesNacido;
    }

    public function getDiasNacido(): string{
        return $this->diasNacido;
    }

    public function setDiasNacido(string $diasNacido): void{
        $this->diasNacido = $diasNacido;
    }

    public function getCodSectorZona(): int{
        return $this->codSectorZona;
    }

    public function setCodSectorZona(int $codSectorZona): void{
        $this->codSectorZona = $codSectorZona;
    }

    public function getDesSectorZona(): string{
        return $this->desSectorZona;
    }

    public function setDesSectorZona(string $desSectorZona): void{
        $this->desSectorZona = $desSectorZona;
    }

    public function getDireccion(): string{
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void{
        $this->direccion = $direccion;
    }

    public function getNumeroFinca(): int{
        return $this->numeroFinca;
    }

    public function setNumeroFinca(int $numeroFinca): void{
        $this->numeroFinca = $numeroFinca;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function guardarPersona(){
        $sql = "EXEC sp_persona_insertar :nombres, :apellidoPaterno, :apellidoMaterno, 
                :dni, :sexo, :telefono, :celular, :fechaNacimiento, :codSectorZona, 
                :direccion, :numeroFinca";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('nombres', $this->nombres, PDO::PARAM_STR);
            $stmt->bindParam('apellidoPaterno', $this->apellidoPaterno, PDO::PARAM_STR);
            $stmt->bindParam('apellidoMaterno', $this->apellidoMaterno, PDO::PARAM_STR);
            $stmt->bindParam('dni', $this->dni, PDO::PARAM_STR);
            $stmt->bindParam('sexo', $this->sexo, PDO::PARAM_STR);
            $stmt->bindParam('telefono', $this->telefono, PDO::PARAM_STR);
            $stmt->bindParam('celular', $this->celular, PDO::PARAM_STR);
            $stmt->bindParam('fechaNacimiento', $this->fechaNacimiento, PDO::PARAM_STR);
            $stmt->bindParam('codSectorZona', $this->codSectorZona, PDO::PARAM_INT);
            $stmt->bindParam('direccion', $this->direccion, PDO::PARAM_STR);
            $stmt->bindParam('numeroFinca', $this->numeroFinca, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Persona registrada exitosamente',
                    'data' => [],
                ];
            } else {
                return [
                    'status' => 'failed',
                    'code' => 400,
                    'message' => 'No se pudo registrar la persona, verifica los datos',
                    'action' => 'guardarPersona',
                    'module' => 'persona',
                    'data' => [],
                ];
            }

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de registrar la persona',
                'action' => 'guardarPersona',
                'module' => 'persona',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarPersonas(string $nombresCompleto){
        $sql = "EXEC sp_persona_listar :dni, :nombresCompleto";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('dni', $this->dni, PDO::PARAM_STR);
            $stmt->bindParam('nombresCompleto', $nombresCompleto, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de personas',
                'action' => 'listarPersonas',
                'module' => 'persona',
                'data' => $result,
                'info' => '',
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar las persona',
                'action' => 'listarPersonas',
                'module' => 'persona',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}
