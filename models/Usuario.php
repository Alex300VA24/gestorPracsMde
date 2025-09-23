<?php

class Usuario {
    private int $codUsuario;
    private string $nombresApellidos;
    private string $nombreUsuario;
    private string $password;
    private int $codRol;
    private string $rol;
    private string $dni;
    private string $cui;
    private int $codEstado;

    public function __construct(){}

    public function getCodUsuario(): int
    {
        return $this->codUsuario;
    }

    public function setCodUsuario(int $codUsuario): void{
        $this->codUsuario = $codUsuario;
    }

    public function getNombresApellidos(): string{
        return $this->nombresApellidos;
    }

    public function setNombresApellidos(string $nombresApellidos): void{
        $this->nombresApellidos = $nombresApellidos;
    }

    public function getNombreUsuario(): string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(string $nombreUsuario): void
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function setPassword(string $password): void{
        $this->password = $password;
    }

    public function getCodRol(): int{
        return $this->codRol;
    }

    public function setCodRol(int $codRol): void{
        $this->codRol = $codRol;
    }

    public function getDni(): string{
        return $this->dni;
    }

    public function setDni(string $dni): void{
        $this->dni = $dni;
    }

    public function getCui(): string{
        return $this->cui;
    }

    public function setCui(string $cui): void{
        $this->cui = $cui;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function autenticarUsuario(){
        $sql = "SELECT u.codUsuario, u.nombresApellidos, u.dni, u.cui, u.nombreUsuario, u.codRol, r.descripcion 'rol',  u.codEstado, e.descripcion 'estado'
                FROM Usuarios u INNER JOIN Roles r ON u.codRol = r.codRol
                JOIN Estados e ON u.codEstado = e.codEstado
                WHERE nombreUsuario = :usuario AND password = :password AND e.descripcion = 'activo'";
           
        try{
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('usuario', $this->nombreUsuario, PDO::PARAM_STR);
            $stmt->bindParam('password', $this->password, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) == 0){
                return [
                    'status' => 'not found',
                    'code' => 404,
                    'message' => 'Credenciales incorrectas',
                    'action' => 'autenticarUsuario',
                    'module' => 'autenticacion',
                    'data' => [],
                    'info' => '',
                ];
            }

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'inicio de sesión correcto',
                'action' => 'login',
                'module' => 'autenticacion',
                'data' => $result[0],
                'info' => '',
            ];
        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de iniciar sesión',
                'action' => 'autenticarUsuario',
                'module' => 'autenticacion',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }


}