<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de Productos
require_once('../models/productos.model.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Productos
$productos = new Productos;

switch ($_GET["op"]) {
    // Obtener todos los registros de productos
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de productos
        $datos = $productos->todos(); // Recuperar todos los registros desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de productos
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de productos por su ID
    case 'uno':
        $idProductos = $_POST["idProductos"];
        $datos = $productos->uno($idProductos); // Recuperar un registro de productos desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo producto en la base de datos
    case 'insertar':
        $Codigo_Barras = $_POST["Codigo_Barras"];
        $Nombre_Producto = $_POST["Nombre_Producto"];
        $Graba_IVA = $_POST["Graba_IVA"];

        $datos = $productos->insertar($Codigo_Barras, $Nombre_Producto, $Graba_IVA); // Insertar el nuevo producto en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un producto existente en la base de datos
    case 'actualizar':
        $idProductos = $_POST["idProductos"];
        $Codigo_Barras = $_POST["Codigo_Barras"];
        $Nombre_Producto = $_POST["Nombre_Producto"];
        $Graba_IVA = $_POST["Graba_IVA"];

        $datos = $productos->actualizar($idProductos, $Codigo_Barras, $Nombre_Producto, $Graba_IVA); // Actualizar el producto en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un producto de la base de datos
    case 'eliminar':
        $idProductos = $_POST["idProductos"];
        $datos = $productos->eliminar($idProductos); // Eliminar el producto de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
