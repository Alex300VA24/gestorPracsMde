<?php

include_once "Persona.php";

class Beneficiario extends Persona{
    private int $codBeneficiario;
    private int $codPersona;
    private int $codSocio;
    private int $codParentesco;
    private string $fechaRegistro;

    /**
     * @param int $codBeneficiario
     * @param int $codPersona
     * @param int $codSocio
     * @param int $codParentesco
     * @param string $fechaRegistro
     */
    public function __construct( string $nombres, string $apellidoPaterno, string $apellidoMaterno,
                                 string $dni, string $sexo, string $telefono, string $celular, string $fechaNacimiento,
                                 int $codSectorZona, string $direccion, $numeroFinca,
        int $codBeneficiario, int $codPersona, int $codSocio, int $codParentesco, string $fechaRegistro)
    {
        parent::__construct($codPersona, $nombres, $apellidoPaterno, $apellidoMaterno,
            $dni, $sexo, $telefono, $celular, $fechaNacimiento, $codSectorZona, $direccion, $numeroFinca);
        $this->codBeneficiario = $codBeneficiario;
        $this->codPersona = $codPersona;
        $this->codSocio = $codSocio;
        $this->codParentesco = $codParentesco;
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getCodBeneficiario(): int{
        return $this->codBeneficiario;
    }

    public function setCodBeneficiario(int $codBeneficiario): void{
        $this->codBeneficiario = $codBeneficiario;
    }

    public function getCodPersona(): int{
        return $this->codPersona;
    }

    public function setCodPersona(int $codPersona): void{
        $this->codPersona = $codPersona;
    }

    public function getCodSocio(): int{
        return $this->codSocio;
    }

    public function setCodSocio(int $codSocio): void{
        $this->codSocio = $codSocio;
    }

    public function getCodParentesco(): int{
        return $this->codParentesco;
    }

    public function setCodParentesco(int $codParentesco): void{
        $this->codParentesco = $codParentesco;
    }

    public function getFechaRegistro(): string{
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(string $fechaRegistro): void{
        $this->fechaRegistro = $fechaRegistro;
    }

    public function registrarBeneficiario($codTipoBeneficio, $talla, $peso, $hmg,
                                          $fechaUltimaMestruacion, $fechaProbableParto, $fechaParto,
                                          $fechaFinLactancia){
        $sql = "EXEC sp_beneficiario_guardar :persona_nombres, :persona_apellidoPaterno, :persona_apellidoMaterno, 
        :persona_dni, :persona_sexo, :persona_telefono, :persona_celular, :persona_fechaNacimiento, :persona_codSectorZona,
        :persona_direccion, :persona_numeroFinca, :beneficiario_codSocio, :beneficiario_codParentesco,
        :historico_codTipoBeneficio, :historico_peso, :historico_talla, :historico_hmg, :historico_fechaUltimaMestruacion,
        :historico_fechaProbableParto, :historico_fechaParto, :historico_fechaFinLactancia";

        try {
            $nombres = parent::getNombres();
            $apellidoPaterno = parent::getApellidoPaterno();
            $apellidoMaterno = parent::getApellidoMaterno();
            $dni = parent::getDni();
            $sexo = parent::getSexo();
            $telefono = parent::getTelefono();
            $celular = parent::getCelular();
            $fechaNacimiento = parent::getFechaNacimiento();
            $codSectorZona = parent::getCodSectorZona();
            $direccion = parent::getDireccion();
            $numeroFinca = parent::getNumeroFinca();

            $peso = $peso == '' ? null : floatval($peso);
            $hmg = $hmg == '' ? null : floatval($hmg);
            $talla = $talla == '' ? null : floatval($talla);

//            return [$nombres, $apellidoMaterno, $apellidoPaterno, $dni, $sexo, $telefono, $celular, $fechaNacimiento,
//                $codSectorZona, $direccion, $numeroFinca, $codTipoBeneficio, $talla, $peso, $hmg, $fechaFinLactancia,$fechaUltimaMestruacion,
//                $fechaProbableParto, $fechaParto, $this->codSocio, $this->codParentesco ];

            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('persona_nombres', $nombres, PDO::PARAM_STR);
            $stmt->bindParam('persona_apellidoPaterno', $apellidoPaterno, PDO::PARAM_STR);
            $stmt->bindParam('persona_apellidoMaterno', $apellidoMaterno, PDO::PARAM_STR);
            $stmt->bindParam('persona_dni', $dni, PDO::PARAM_STR);
            $stmt->bindParam('persona_sexo', $sexo, PDO::PARAM_STR);
            $stmt->bindParam('persona_telefono', $telefono, PDO::PARAM_STR);
            $stmt->bindParam('persona_celular', $celular, PDO::PARAM_STR);
            $stmt->bindParam('persona_fechaNacimiento', $fechaNacimiento, PDO::PARAM_STR);
            $stmt->bindParam('persona_codSectorZona', $codSectorZona, PDO::PARAM_INT);
            $stmt->bindParam('persona_direccion', $direccion, PDO::PARAM_STR);
            $stmt->bindParam('persona_numeroFinca', $numeroFinca, PDO::PARAM_INT);
            $stmt->bindParam('beneficiario_codSocio', $this->codSocio, PDO::PARAM_INT);
            $stmt->bindParam('beneficiario_codParentesco', $this->codParentesco, PDO::PARAM_INT);
            $stmt->bindParam('historico_codTipoBeneficio', $codTipoBeneficio, PDO::PARAM_INT);
            $stmt->bindParam('historico_peso', $peso, PDO::PARAM_STR);
            $stmt->bindParam('historico_talla', $talla, PDO::PARAM_STR);
            $stmt->bindParam('historico_hmg', $hmg, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaUltimaMestruacion', $fechaUltimaMestruacion, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaProbableParto', $fechaProbableParto, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaParto', $fechaParto, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaFinLactancia', $fechaFinLactancia, PDO::PARAM_STR);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result[0]['status']!='error') {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Socio y Beneficiario(s) registrados exitosamente',
                    'data' => [],
                ];
            } else {
                throw new Exception($result[0]['ErrorMessage']);
            }

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de registrar los beneficiarios',
                'action' => 'registrarBeneficiario',
                'module' => 'beneficiario',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }


    public function listarBeneficiarios($dniOApellidosNombres, $codAsociacion, $edadMinima, $edadMaxima){
        $sql = "EXEC sp_beneficiario_listar :dni_o_apellidos_nombres, :codAsociacion, :edad_minima, :edad_maxima";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('dni_o_apellidos_nombres',$dniOApellidosNombres, PDO::PARAM_STR);
            $stmt->bindParam('codAsociacion',$codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('edad_minima',$edadMinima, PDO::PARAM_INT);
            $stmt->bindParam('edad_maxima',$edadMaxima, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de beneficiarios',
                'data' => $result,
            ];

        }catch (Exception $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los beneficiarios',
                'action' => 'listarBeneficiarios',
                'module' => 'beneficiario',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }
}