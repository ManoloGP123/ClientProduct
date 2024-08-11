<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de IVA
require_once('../models/iva.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Iva
$iva = new Iva;

switch ($_GET["op"]) {
    // Obtener todos los registros de IVA
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de IVA
        $datos = $iva->todos(); // Recuperar todos los registros desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de IVA
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de IVA por su ID
    case 'uno':
        $idIVA = $_POST["idIVA"];
        $datos = $iva->uno($idIVA); // Recuperar un registro de IVA desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de IVA
    case 'insertar':
        $Detalle = $_POST["Detalle"];
        $Estado = $_POST["Estado"];
        $Valor = $_POST["Valor"];

        $datos = $iva->insertar($Detalle, $Estado, $Valor); // Insertar el nuevo registro de IVA en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de IVA existente
    case 'actualizar':
        $idIVA = $_POST["idIVA"];
        $Detalle = $_POST["Detalle"];
        $Estado = $_POST["Estado"];
        $Valor = $_POST["Valor"];

        $datos = $iva->actualizar($idIVA, $Detalle, $Estado, $Valor); // Actualizar el registro de IVA en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de IVA
    case 'eliminar':
        $idIVA = $_POST["idIVA"];
        $datos = $iva->eliminar($idIVA); // Eliminar el registro de IVA de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
