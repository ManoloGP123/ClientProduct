<?php
// TODO: Definir la clase para manejar IVA
require_once('../config/config.php');
class Iva
{
    // TODO: Implementar los métodos para gestionar IVA

    public function todos() // Obtiene todos los registros de IVA
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `iva`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idIVA) // Obtiene un registro de IVA específico por ID
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `iva` WHERE `idIVA`=$idIVA";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Detalle, $Estado, $Valor) // Inserta un nuevo registro de IVA
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `iva` (`Detalle`, `Estado`, `Valor`) VALUES ('$Detalle', '$Estado', '$Valor')";
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

    public function actualizar($idIVA, $Detalle, $Estado, $Valor) // Actualiza un registro de IVA existente
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `iva` SET `Detalle`='$Detalle', `Estado`='$Estado', `Valor`='$Valor' WHERE `idIVA` = $idIVA";
            if (mysqli_query($con, $cadena)) {
                return $idIVA;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idIVA) // Elimina un registro de IVA específico por ID
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `iva` WHERE `idIVA`= $idIVA";
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
