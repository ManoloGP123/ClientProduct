<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de clientes
require_once('../models/clientes.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Clientes
$clientes = new Clientes;

switch ($_GET["op"]) {
    // Obtener todos los registros de clientes
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de clientes
        $datos = $clientes->todos(); // Recuperar todos los registros de clientes desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de clientes
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de cliente por su ID
    case 'uno':
        $idClientes = $_POST["idClientes"];
        $datos = $clientes->uno($idClientes); // Recuperar un registro de cliente desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de cliente
    case 'insertar':
        $Nombres = $_POST["Nombres"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Cedula = $_POST["Cedula"];
        $Correo = $_POST["Correo"];

        $datos = $clientes->insertar($Nombres, $Direccion, $Telefono, $Cedula, $Correo); // Insertar el nuevo registro de cliente en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de cliente existente
    case 'actualizar':
        $idClientes = $_POST["idClientes"];
        $Nombres = $_POST["Nombres"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Cedula = $_POST["Cedula"];
        $Correo = $_POST["Correo"];

        $datos = $clientes->actualizar($idClientes, $Nombres, $Direccion, $Telefono, $Cedula, $Correo); // Actualizar el registro de cliente en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de cliente
    case 'eliminar':
        $idClientes = $_POST["idClientes"];
        $datos = $clientes->eliminar($idClientes); // Eliminar el registro de cliente de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
