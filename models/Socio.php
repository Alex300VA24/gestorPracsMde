<?php

include_once "Persona.php";
include_once "Beneficiario.php";

class Socio extends Persona {
    private int $codSocio;
    private int $codAsociacion;
    private string $nombreAsociacion;
    private string $fechaInicio;
    private string $fechaFin;
    private string $observaciones;
    private int $codEstado;
    private string $descripcionEstado;

    public function __construct(int $codSocio, int $codAsociacion,
                                int $codPersona, string $nombres, string $apellidoPaterno, string $apellidoMaterno,
                                string $dni, string $sexo, string $telefono, string $celular, string $fechaNacimiento,
                                int $codSectorZona, string $direccion, int $numeroFinca){
        parent::__construct($codPersona, $nombres, $apellidoPaterno, $apellidoMaterno,
            $dni, $sexo, $telefono, $celular, $fechaNacimiento, $codSectorZona, $direccion, $numeroFinca);
        $this->codSocio = $codSocio;
        $this->codAsociacion = $codAsociacion;
    }

    public function getCodSocio(): int{
        return $this->codSocio;
    }

    public function setCodSocio(int $codSocio): void{
        $this->codSocio = $codSocio;
    }

    public function getCodAsociacion(): int{
        return $this->codAsociacion;
    }

    public function setCodAsociacion(int $codAsociacion): void{
        $this->codAsociacion = $codAsociacion;
    }

    public function getNombreAsociacion(): string{
        return $this->nombreAsociacion;
    }

    public function setNombreAsociacion(string $nombreAsociacion): void{
        $this->nombreAsociacion = $nombreAsociacion;
    }

    public function getFechaInicio(): string{
        return $this->fechaInicio;
    }

    public function setFechaInicio(string $fechaInicio): void{
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin(): string{
        return $this->fechaFin;
    }

    public function setFechaFin(string $fechaFin): void{
        $this->fechaFin = $fechaFin;
    }

    public function getObservaciones(): string{
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): void{
        $this->observaciones = $observaciones;
    }

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function getDescripcionEstado(): string{
        return $this->descripcionEstado;
    }

    public function setDescripcionEstado(string $descripcionEstado): void{
        $this->descripcionEstado = $descripcionEstado;
    }

    public function listarSocios($dniOApellidosNombres, $codAsociacion){
        $sql = "EXEC sp_socio_listar :dni_o_apellidos_nombres, :codAsociacion";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('dni_o_apellidos_nombres',$dniOApellidosNombres, PDO::PARAM_STR);
            $stmt->bindParam('codAsociacion',$codAsociacion, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de socios',
                'data' => $result,
            ];

        }catch (Exception $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los socios',
                'action' => 'listarSocios',
                'module' => 'socios',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }


    public function buscarByDNI(string $dni){
        $sql = "EXEC sp_socio_buscar_por_dni :codAsociacion, :dni";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codAsociacion', $this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('dni', $dni, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if ($stmt->rowCount() > 0){
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'datos del socio',
                    'action' => 'buscarByDNI',
                    'module' => 'socio',
                    'data' => $result[0],
                    'info' => '',
                ];
            }else{
                return [
                    'status' => 'success',
                    'code' => 404,
                    'message' => 'El socio que intenta buscar no se encuentra en el club de madre seleccionado o no está activo.',
                    'data' => [],
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de buscar el socio por DNI y club de madre',
                'action' => 'buscarByDNI',
                'module' => 'socio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function registrarSocio(int $esSocioBeneficiario, $codParentesco, $codTipoBeneficio, $talla,
                                   $peso, $hmg, $fechaUltimaMestruacion, $fechaProbableParto, $fechaParto, $fechaFinLactancia,
                                   $beneficiarios){
        $sql = "EXEC sp_socio_guardar :persona_nombres, :persona_apellidoPaterno, :persona_apellidoMaterno, 
        :persona_dni, :persona_sexo, :persona_telefono, :persona_celular, :persona_fechaNacimiento, :persona_codSectorZona,
        :persona_direccion, :persona_numeroFinca, :socio_codAsociacion, :socio_observacion, :es_socio_beneficiario, :beneficiario_codParentesco,
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

            $fechaUltimaMestruacion = $fechaUltimaMestruacion == '' ? null : $fechaUltimaMestruacion;
            $fechaProbableParto = $fechaProbableParto == '' ? null : $fechaProbableParto;
            $fechaParto = $fechaParto == '' ? null : $fechaParto;
            $fechaFinLactancia = $fechaFinLactancia == '' ? null : $fechaFinLactancia;


//            return [$peso, $hmg, $talla];

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
            $stmt->bindParam('socio_codAsociacion', $this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('socio_observacion', $this->observaciones, PDO::PARAM_STR);
            $stmt->bindParam('es_socio_beneficiario', $esSocioBeneficiario, PDO::PARAM_INT);
            $stmt->bindParam('beneficiario_codParentesco', $codParentesco, PDO::PARAM_INT);
            $stmt->bindParam('historico_codTipoBeneficio', $codTipoBeneficio, PDO::PARAM_INT);
            $stmt->bindParam('historico_peso', $peso, PDO::PARAM_STR);
            $stmt->bindParam('historico_talla', $talla, PDO::PARAM_STR);
            $stmt->bindParam('historico_hmg', $hmg, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaUltimaMestruacion', $fechaUltimaMestruacion, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaProbableParto', $fechaProbableParto, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaParto', $fechaParto, PDO::PARAM_STR);
            $stmt->bindParam('historico_fechaFinLactancia', $fechaFinLactancia, PDO::PARAM_STR);

//                        return [ $talla, $peso, $hmg, $fechaFinLactancia,$fechaUltimaMestruacion,
//                $fechaProbableParto, $fechaParto ];


            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (isset($result[0]['codSocio']) && is_array($beneficiarios) && count($beneficiarios) > 0){
                $codSocio = $result[0]['codSocio'];
                $contadorBeneficiariosRegistrados = 0;
                $response = [];

                for ($i = 0; $i < count($beneficiarios); $i++ ){
                    $nombresBenef = $beneficiarios[$i]['nombres'];
                    $apellidoPaternoBenef = $beneficiarios[$i]['apellidoPaterno'];
                    $apellidoMaternoBenef = $beneficiarios[$i]['apellidoMaterno'];
                    $celularBenef = $beneficiarios[$i]['celular'];
                    $telefonoBenef = $beneficiarios[$i]['telefono'];
                    $direccionBenef = $beneficiarios[$i]['direccion'];
                    $dniBenef = $beneficiarios[$i]['dni'];
                    $tipoBeneficioBenef = $beneficiarios[$i]['tipoBeneficio'];
                    $fechaNacimientoBenef = $beneficiarios[$i]['fechaNacimiento'];
                    $fechaUltimaMestruacionBenef = $beneficiarios[$i]['fechaUltimaMestruacion'];
                    $fechaProbablePartoBenef = $beneficiarios[$i]['fechaProbableParto'];
                    $fechaPartoBenef = $beneficiarios[$i]['fechaParto'];
                    $fechaFinLactanciaBenef = $beneficiarios[$i]['fechaFinLactancia'];
                    $numeroFincaBenef = $beneficiarios[$i]['numeroFinca'];
                    $parentescoBenef = $beneficiarios[$i]['parentesco'];
                    $sectorYZonaBenef = $beneficiarios[$i]['sectorYZona'];
                    $sexoBenef = $beneficiarios[$i]['sexo'];
                    $pesoBenef = $beneficiarios[$i]['peso'];
                    $hmgBenef = $beneficiarios[$i]['hmg'];
                    $tallaBenef = $beneficiarios[$i]['talla'];

                    $fechaUltimaMestruacionBenef = $fechaUltimaMestruacionBenef == '' ? null : $fechaUltimaMestruacionBenef;
                    $fechaProbablePartoBenef = $fechaProbablePartoBenef == '' ? null : $fechaProbablePartoBenef;
                    $fechaPartoBenef = $fechaPartoBenef == '' ? null : $fechaPartoBenef;
                    $fechaFinLactanciaBenef = $fechaFinLactanciaBenef == '' ? null : $fechaFinLactanciaBenef;

                    $objBeneficiario = new Beneficiario($nombresBenef, $apellidoPaternoBenef, $apellidoMaternoBenef, $dniBenef,
                    $sexoBenef, $telefonoBenef, $celularBenef, $fechaNacimientoBenef, $sectorYZonaBenef, $direccionBenef,
                    $numeroFincaBenef, 0, 0, (int) $codSocio, (int) $parentescoBenef, '');

                    $response = $objBeneficiario->registrarBeneficiario((int) $tipoBeneficioBenef, $tallaBenef, $pesoBenef, $hmgBenef,
                    $fechaUltimaMestruacionBenef, $fechaProbablePartoBenef, $fechaPartoBenef, $fechaFinLactanciaBenef);

                    if ($response['code'] === 200){
                        $contadorBeneficiariosRegistrados++;
                    }
                }

//                return $response;

                if ($contadorBeneficiariosRegistrados === count($beneficiarios)){
                    return [
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Socio y Beneficiario(s) registrados exitosamente',
                        'data' => [],
                    ];
                }else{
                    return $response;
                }
            }else{
                if ($result[0]['status']!='error'){
                    return [
                        'status' => 'success',
                        'code' => 200,
                        'message' => 'Socio registrado exitosamente',
                        'data' => [],
                    ];
                }else{
                    return [
                        'status' => 'failed',
                        'code' => 500,
                        'message' => 'Ocurrio un error al momento de registrar el socio',
                        'action' => 'registrarSocio',
                        'module' => 'socio',
                        'data' => [],
                        'info' => $result
                    ];
                }
            }

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de registrar el socio',
                'action' => 'registrarSocio',
                'module' => 'socio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function actualizarSocio(){
        $sql = "EXEC sp_socio_actualizar :persona_codPersona, :persona_nombres, :persona_apellidoPaterno, :persona_apellidoMaterno, 
        :persona_dni, :persona_sexo, :persona_telefono, :persona_celular, :persona_fechaNacimiento, :persona_codSectorZona,
        :persona_direccion, :persona_numeroFinca, :socio_codSocio, :socio_codAsociacion, :socio_observacion";

        try {
            $codPersona = parent::getCodPersona();
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

            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('persona_codPersona', $codPersona, PDO::PARAM_INT);
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
            $stmt->bindParam('socio_codSocio', $this->codSocio, PDO::PARAM_INT);
            $stmt->bindParam('socio_codAsociacion', $this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('socio_observacion', $this->observaciones, PDO::PARAM_STR);

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result[0]['status']!='error') {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Socio actualizado exitosamente',
                    'data' => [],
                ];
            } else {
                throw new Exception($result[0]['ErrorMessage']);
            }

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de actualizar los datos del socio',
                'action' => 'actualizarSocio',
                'module' => 'socio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function buscarBeneficiarios(){
        $sql = "EXEC sp_socio_buscar_beneficiarios :codSocio";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codSocio', $this->codSocio, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


            if ($stmt->rowCount() > 0){
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'beneficiarios del socio',
                    'action' => 'buscarBeneficiarios',
                    'module' => 'socio',
                    'data' => $result,
                    'info' => '',
                ];
            }else{
                return [
                    'status' => 'success',
                    'code' => 404,
                    'message' => 'El socio no tiene ningun beneficiario',
                    'data' => [],
                ];
            }


        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de buscar el socio por DNI y club de madre',
                'action' => 'buscarByDNI',
                'module' => 'socio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function inhabilitarSocio(){
        $sql = "EXEC sp_socio_inhabilitar :codSocio";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codSocio', $this->codSocio, PDO::PARAM_INT);
            $stmt->execute();

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'socio inhabilitado correctamente',
                'action' => 'inhabilitarSocio',
                'module' => 'socio',
                'data' => '',
                'info' => '',
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de inhabilitar el socio',
                'action' => 'inhabilitarSocio',
                'module' => 'socio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function habilitarSocio(){
        $sql = "EXEC sp_socio_habilitar :codSocio";

        
        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codSocio', $this->codSocio, PDO::PARAM_INT);
            $stmt->execute();

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'socio habilitado correctamente',
                'action' => 'habilitarSocio',
                'module' => 'socio',
                'data' => '',
                'info' => '',
            ];

        }catch (PDOException $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de habilitar el socio',
                'action' => 'habilitarSocio',
                'module' => 'socio',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

}