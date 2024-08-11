<?php
// TODO: Definir la clase para manejar detalles de factura
require_once('../config/config.php');
class Detalle_Factura
{
    // TODO: Implementar los métodos para gestión de detalles de factura

    public function todos() // Obtiene todos los registros de detalle de factura
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `detalle_factura`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($idDetalle_Factura) // Obtiene un detalle de factura específico por ID
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `detalle_factura` WHERE `idDetalle_Factura`=$idDetalle_Factura";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function insertar($Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item) // Inserta un nuevo detalle de factura
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `detalle_factura` (`Cantidad`, `Factura_idFactura`, `Kardex_idKardex`, `Precio_Unitario`, `Sub_Total_item`) VALUES ('$Cantidad', '$Factura_idFactura', '$Kardex_idKardex', '$Precio_Unitario', '$Sub_Total_item')";
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

    public function actualizar($idDetalle_Factura, $Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item) // Actualiza un detalle de factura existente
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `detalle_factura` SET `Cantidad`='$Cantidad', `Factura_idFactura`='$Factura_idFactura', `Kardex_idKardex`='$Kardex_idKardex', `Precio_Unitario`='$Precio_Unitario', `Sub_Total_item`='$Sub_Total_item' WHERE `idDetalle_Factura` = $idDetalle_Factura";
            if (mysqli_query($con, $cadena)) {
                return $idDetalle_Factura;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    public function eliminar($idDetalle_Factura) // Elimina un detalle de factura específico por ID
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `detalle_factura` WHERE `idDetalle_Factura`= $idDetalle_Factura";
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
