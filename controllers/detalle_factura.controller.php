<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de detalle de factura
require_once('../models/detalle_factura.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Detalle_Factura
$detalle_factura = new Detalle_Factura;

switch ($_GET["op"]) {
    // Obtener todos los registros de detalles de factura
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de detalle de factura
        $datos = $detalle_factura->todos(); // Recuperar todos los registros desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de detalle de factura
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de detalle de factura por su ID
    case 'uno':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $datos = $detalle_factura->uno($idDetalle_Factura); // Recuperar un registro de detalle de factura desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo detalle de factura
    case 'insertar':
        $Cantidad = $_POST["Cantidad"];
        $Factura_idFactura = $_POST["Factura_idFactura"];
        $Kardex_idKardex = $_POST["Kardex_idKardex"];
        $Precio_Unitario = $_POST["Precio_Unitario"];
        $Sub_Total_item = $_POST["Sub_Total_item"];

        $datos = $detalle_factura->insertar($Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item); // Insertar el nuevo detalle de factura en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de detalle de factura existente
    case 'actualizar':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $Cantidad = $_POST["Cantidad"];
        $Factura_idFactura = $_POST["Factura_idFactura"];
        $Kardex_idKardex = $_POST["Kardex_idKardex"];
        $Precio_Unitario = $_POST["Precio_Unitario"];
        $Sub_Total_item = $_POST["Sub_Total_item"];

        $datos = $detalle_factura->actualizar($idDetalle_Factura, $Cantidad, $Factura_idFactura, $Kardex_idKardex, $Precio_Unitario, $Sub_Total_item); // Actualizar el registro de detalle de factura en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de detalle de factura
    case 'eliminar':
        $idDetalle_Factura = $_POST["idDetalle_Factura"];
        $datos = $detalle_factura->eliminar($idDetalle_Factura); // Eliminar el registro de detalle de factura de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
