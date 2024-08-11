<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de Kardex
require_once('../models/kardex.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Kardex
$kardex = new Kardex;

switch ($_GET["op"]) {
    // Obtener todos los registros de Kardex
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de Kardex
        $datos = $kardex->todos(); // Recuperar todos los registros desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de Kardex
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de Kardex por su ID
    case 'uno':
        $idKardex = $_POST["idKardex"];
        $datos = $kardex->uno($idKardex); // Recuperar un registro de Kardex desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de Kardex
    case 'insertar':
        $Estado = $_POST["Estado"];
        $Fecha_Transaccion = $_POST["Fecha_Transaccion"];
        $Cantidad = $_POST["Cantidad"];
        $Valor_Compra = $_POST["Valor_Compra"];
        $Valor_Venta = $_POST["Valor_Venta"];
        $Unidad_Medida_idUnidad_Medida = $_POST["Unidad_Medida_idUnidad_Medida"];
        $Unidad_Medida_idUnidad_Medida1 = $_POST["Unidad_Medida_idUnidad_Medida1"];
        $Unidad_Medida_idUnidad_Medida2 = $_POST["Unidad_Medida_idUnidad_Medida2"];
        $Valor_Ganacia = $_POST["Valor_Ganacia"];
        $IVA = $_POST["IVA"];
        $IVA_idIVA = $_POST["IVA_idIVA"];
        $Proveedores_idProveedores = $_POST["Proveedores_idProveedores"];
        $Productos_idProductos = $_POST["Productos_idProductos"];
        $Tipo_Transaccion = $_POST["Tipo_Transaccion"];

        $datos = $kardex->insertar($Estado, $Fecha_Transaccion, $Cantidad, $Valor_Compra, $Valor_Venta, $Unidad_Medida_idUnidad_Medida, $Unidad_Medida_idUnidad_Medida1, $Unidad_Medida_idUnidad_Medida2, $Valor_Ganacia, $IVA, $IVA_idIVA, $Proveedores_idProveedores, $Productos_idProductos, $Tipo_Transaccion); // Insertar el nuevo registro de Kardex en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de Kardex existente
    case 'actualizar':
        $idKardex = $_POST["idKardex"];
        $Estado = $_POST["Estado"];
        $Fecha_Transaccion = $_POST["Fecha_Transaccion"];
        $Cantidad = $_POST["Cantidad"];
        $Valor_Compra = $_POST["Valor_Compra"];
        $Valor_Venta = $_POST["Valor_Venta"];
        $Unidad_Medida_idUnidad_Medida = $_POST["Unidad_Medida_idUnidad_Medida"];
        $Unidad_Medida_idUnidad_Medida1 = $_POST["Unidad_Medida_idUnidad_Medida1"];
        $Unidad_Medida_idUnidad_Medida2 = $_POST["Unidad_Medida_idUnidad_Medida2"];
        $Valor_Ganacia = $_POST["Valor_Ganacia"];
        $IVA = $_POST["IVA"];
        $IVA_idIVA = $_POST["IVA_idIVA"];
        $Proveedores_idProveedores = $_POST["Proveedores_idProveedores"];
        $Productos_idProductos = $_POST["Productos_idProductos"];
        $Tipo_Transaccion = $_POST["Tipo_Transaccion"];

        $datos = $kardex->actualizar($idKardex, $Estado, $Fecha_Transaccion, $Cantidad, $Valor_Compra, $Valor_Venta, $Unidad_Medida_idUnidad_Medida, $Unidad_Medida_idUnidad_Medida1, $Unidad_Medida_idUnidad_Medida2, $Valor_Ganacia, $IVA, $IVA_idIVA, $Proveedores_idProveedores, $Productos_idProductos, $Tipo_Transaccion); // Actualizar el registro de Kardex en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de Kardex
    case 'eliminar':
        $idKardex = $_POST["idKardex"];
        $datos = $kardex->eliminar($idKardex); // Eliminar el registro de Kardex de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
