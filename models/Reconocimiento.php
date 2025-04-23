<?php
class Reconocimiento{
    private int $codReconocimiento;
    private int $codAsociacion;
    private string $nombreAsociacion;
    private string $documento;
    private string  $fechaInicio;
    private string $fechaFin;
    private int $codEstado;
    private string $estadoDescripcion;
    private ?string $pdfPath = null;

    public function getCodReconocimiento(): int{
        return $this->codReconocimiento;
    }

    public function setCodReconocimiento(int $codReconocimiento): void{
        $this->codReconocimiento = $codReconocimiento;
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

    public function getDocumento(): string{
        return $this->documento;
    }

    public function setDocumento(string $documento): void{
        $this->documento = $documento;
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

    public function getCodEstado(): int{
        return $this->codEstado;
    }

    public function setCodEstado(int $codEstado): void{
        $this->codEstado = $codEstado;
    }

    public function getEstadoDescripcion(): string{
        return $this->estadoDescripcion;
    }

    public function setEstadoDescripcion(string $estadoDescripcion): void{
        $this->estadoDescripcion = $estadoDescripcion;
    }
    public function getPdfPath(): ?string {
        return $this->pdfPath;
    }

    public function setPdfPath(?string $pdfPath) : void {
        $sql->pdfPath = $pdfPath;
    }



    public function registrarReconocimiento(int $presidente, int $vicePresidente, int $secretaria, int $tesorera, int $vocal, int $coordinadora, int $almacenera, int $fiscalizador){
        $sql = "EXEC sp_reconocimiento_directivas_registrar 
        :codAsociacion, 
        :documento, 
        :fechaInicio, 
        :fechaFin,
        :codSocioPresidenta, 
        :codSocioVicePresidenta, 
        :codSocioSecretaria,
        :codSocioTesorera,
        :codSocioVocal,
        :codSocioCoordinadora,
        :codSocioAlmacenera,
        :codSocioFiscalizador";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('codAsociacion',$this->codAsociacion, PDO::PARAM_INT);
            $stmt->bindParam('documento',$this->documento, PDO::PARAM_STR);
            $stmt->bindParam('fechaInicio',$this->fechaInicio, PDO::PARAM_STR);
            $stmt->bindParam('fechaFin',$this->fechaFin, PDO::PARAM_STR);
            $stmt->bindParam('codSocioPresidenta',$presidente, PDO::PARAM_INT);
            $stmt->bindParam('codSocioVicePresidenta',$vicePresidente, PDO::PARAM_INT);
            $stmt->bindParam('codSocioSecretaria',$secretaria, PDO::PARAM_INT);
            $stmt->bindParam('codSocioTesorera',$tesorera, PDO::PARAM_INT);
            $stmt->bindParam('codSocioVocal',$vocal, PDO::PARAM_INT);
            $stmt->bindParam('codSocioCoordinadora',$coordinadora, PDO::PARAM_INT);
            $stmt->bindParam('codSocioAlmacenera',$almacenera, PDO::PARAM_INT);
            $stmt->bindParam('codSocioFiscalizador',$fiscalizador, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result[0]['status']!='error') {
                return [
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Reconocimiento registrado exitosamente',
                    'data' => [],
                ];
            } else {
                throw new Exception($result[0]['ErrorMessage']);
            }

        }catch (Exception $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de registrar el reconocimiento',
                'action' => 'registrarReconocimiento',
                'module' => 'reconocimiento',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function listarReconocimientos($documento, $codAsociacion){
        $sql = "EXEC sp_reconocimiento_listar :documento, :codAsociacion";

        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('documento',$documento, PDO::PARAM_STR);
            $stmt->bindParam('codAsociacion',$codAsociacion, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'lista de reconocimientoss',
                'data' => $result,
            ];

        }catch (Exception $e){
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Ocurrio un error al momento de listar los reconocimientos',
                'action' => 'listarReconocimientos',
                'module' => 'reconocimiento',
                'data' => [],
                'info' => $e->getMessage()
            ];
        }
    }

    public function subirPdf(int $codReconocimiento, string $pdfPath): array {
        $sql = "UPDATE reconocimientos SET pdf_path = :pdfPath WHERE cod_reconocimiento = :codReconocimiento";
        try {
            $stmt = DataBase::connect()->prepare($sql);
            $stmt->bindParam('pdfPath', $pdfPath, PDO::PARAM_STR);
            $stmt->bindParam('codReconocimiento', $codReconocimiento, PDO::PARAM_INT);
            $stmt->execute();

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'PDF subido correctamente',
            ];
        } catch (Exception $e) {
            return [
                'status' => 'failed',
                'code' => 500,
                'message' => 'Error al subir el PDF',
                'info' => $e->getMessage(),
            ];
        }
    }

}