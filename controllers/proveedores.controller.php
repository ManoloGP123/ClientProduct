<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Controlador para la gestión de proveedores

require_once('../models/proveedores.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Proveedores
$proveedores = new Proveedores;

switch ($_GET["op"]) {
    // Obtener todos los registros de proveedores
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de proveedores
        $datos = $proveedores->todos(); // Recuperar todos los registros desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de proveedores
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de proveedor por su ID
    case 'uno':
        $idProveedores = $_POST["idProveedores"];
        $datos = $proveedores->uno($idProveedores); // Recuperar un registro de proveedor desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo proveedor en la base de datos
    case 'insertar':
        $Nombre_Empresa = $_POST["Nombre_Empresa"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Contacto_Empresa = $_POST["Contacto_Empresa"];
        $Telefono_Contacto = $_POST["Telefono_Contacto"];

        $datos = $proveedores->insertar($Nombre_Empresa, $Direccion, $Telefono, $Contacto_Empresa, $Telefono_Contacto); // Insertar el nuevo proveedor en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un proveedor existente en la base de datos
    case 'actualizar':
        $idProveedores = $_POST["idProveedores"];
        $Nombre_Empresa = $_POST["Nombre_Empresa"];
        $Direccion = $_POST["Direccion"];
        $Telefono = $_POST["Telefono"];
        $Contacto_Empresa = $_POST["Contacto_Empresa"];
        $Telefono_Contacto = $_POST["Telefono_Contacto"];

        $datos = $proveedores->actualizar($idProveedores, $Nombre_Empresa, $Direccion, $Telefono, $Contacto_Empresa, $Telefono_Contacto); // Actualizar el proveedor en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un proveedor de la base de datos
    case 'eliminar':
        $idProveedores = $_POST["idProveedores"];
        $datos = $proveedores->eliminar($idProveedores); // Eliminar el proveedor de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
