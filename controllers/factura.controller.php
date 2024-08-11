<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de factura
require_once('../models/factura.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Factura
$factura = new Factura;

switch ($_GET["op"]) {
    // Obtener todos los registros de facturas
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de facturas
        $datos = $factura->todos(); // Recuperar todos los registros desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de facturas
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de factura por su ID
    case 'uno':
        $idFactura = $_POST["idFactura"];
        $datos = $factura->uno($idFactura); // Recuperar un registro de factura desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar una nueva factura
    case 'insertar':
        $Fecha = $_POST["Fecha"];
        $Sub_total = $_POST["Sub_total"];
        $Sub_total_iva = $_POST["Sub_total_iva"];
        $Valor_IVA = $_POST["Valor_IVA"];
        $Clientes_idClientes = $_POST["Clientes_idClientes"];

        $datos = $factura->insertar($Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes); // Insertar la nueva factura en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de factura existente
    case 'actualizar':
        $idFactura = $_POST["idFactura"];
        $Fecha = $_POST["Fecha"];
        $Sub_total = $_POST["Sub_total"];
        $Sub_total_iva = $_POST["Sub_total_iva"];
        $Valor_IVA = $_POST["Valor_IVA"];
        $Clientes_idClientes = $_POST["Clientes_idClientes"];

        $datos = $factura->actualizar($idFactura, $Fecha, $Sub_total, $Sub_total_iva, $Valor_IVA, $Clientes_idClientes); // Actualizar el registro de factura en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de factura
    case 'eliminar':
        $idFactura = $_POST["idFactura"];
        $datos = $factura->eliminar($idFactura); // Eliminar el registro de factura de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
