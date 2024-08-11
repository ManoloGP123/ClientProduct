<?php
//TODO: Clase de Proveedores
require_once('../config/config.php');
class Provedores
{
    //TODO: Implementar los métodos de la clase

    public function todos() // Obtiene todos los registros de la tabla proveedores
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `proveedores`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idProveedores) // Obtiene un registro específico de la tabla proveedores por id
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `proveedores` WHERE `idProveedores`=$idProveedores";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Nombre_Empresa, $Direccion, $Telefono, $Contacto_Empresa, $Teleofno_Contacto) // Inserta un nuevo registro en la tabla proveedores
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `proveedores` (`Nombre_Empresa`, `Direccion`, `Telefono`, `Contacto_Empresa`, `Teleofno_Contacto`) VALUES ('$Nombre_Empresa', '$Direccion', '$Telefono', '$Contacto_Empresa', '$Teleofno_Contacto')";
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

    public function actualizar($idProveedores, $Nombre_Empresa, $Direccion, $Telefono, $Contacto_Empresa, $Teleofno_Contacto) // Actualiza un registro existente en la tabla proveedores por id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `proveedores` SET `Nombre_Empresa`='$Nombre_Empresa', `Direccion`='$Direccion', `Telefono`='$Telefono', `Contacto_Empresa`='$Contacto_Empresa', `Teleofno_Contacto`='$Teleofno_Contacto' WHERE `idProveedores` = $idProveedores";
            if (mysqli_query($con, $cadena)) {
                return $idProveedores;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idProveedores) // Elimina un registro de la tabla proveedores por id
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `proveedores` WHERE `idProveedores`= $idProveedores";
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
