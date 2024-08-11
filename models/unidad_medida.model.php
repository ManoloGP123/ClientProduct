<?php
//TODO: Clase de Unidad_Medida
require_once('../config/config.php');
class Unidad_Medida
{
    //TODO: Implementar los métodos de la clase

    public function todos() // Obtiene todos los registros de la tabla unidad_medida
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `unidad_medida`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idUnidad_Medida) // Obtiene un registro específico de la tabla unidad_medida por id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `unidad_medida` WHERE `idUnidad_Medida`=$idUnidad_Medida";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Detalle, $Tipo) // Inserta un nuevo registro en la tabla unidad_medida
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `unidad_medida` (`Detalle`, `Tipo`) VALUES ('$Detalle', '$Tipo')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function actualizar($idUnidad_Medida, $Detalle, $Tipo) // Actualiza un registro existente en la tabla unidad_medida por id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `unidad_medida` SET `Detalle`='$Detalle', `Tipo`='$Tipo' WHERE `idUnidad_Medida` = $idUnidad_Medida";
            if (mysqli_query($con, $cadena)) {
                return $idUnidad_Medida;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idUnidad_Medida) // Elimina un registro de la tabla unidad_medida por id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `unidad_medida` WHERE `idUnidad_Medida`= $idUnidad_Medida";
            // echo $cadena;
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
