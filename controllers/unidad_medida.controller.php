<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Controlador para la gestión de unidades de medida

require_once('../models/unidad_medida.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Unidad_Medida
$unidad_medida = new Unidad_Medida;

switch ($_GET["op"]) {
    // Obtener todos los registros de unidades de medida
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de unidades de medida
        $datos = $unidad_medida->todos(); // Recuperar todos los registros desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de unidades de medida
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de unidad de medida por su ID
    case 'uno':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $datos = $unidad_medida->uno($idUnidad_Medida); // Recuperar un registro de unidad de medida desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar una nueva unidad de medida en la base de datos
    case 'insertar':
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];

        $datos = $unidad_medida->insertar($Detalle, $Tipo); // Insertar la nueva unidad de medida en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar una unidad de medida existente en la base de datos
    case 'actualizar':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $Detalle = $_POST["Detalle"];
        $Tipo = $_POST["Tipo"];

        $datos = $unidad_medida->actualizar($idUnidad_Medida, $Detalle, $Tipo); // Actualizar la unidad de medida en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar una unidad de medida de la base de datos
    case 'eliminar':
        $idUnidad_Medida = $_POST["idUnidad_Medida"];
        $datos = $unidad_medida->eliminar($idUnidad_Medida); // Eliminar la unidad de medida de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
