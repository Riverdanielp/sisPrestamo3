<?php
require_once 'Conexion.php';
require_once 'Documento.php';
require_once 'Bitacora.php';
session_start();
$conn = new Conexion();

$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$observaciones = $_POST['observaciones'];
$profesion = $_POST['profesion'];

$stmn = "UPDATE cliente SET telefonos = '" . $telefono . "', direccion = '" . $direccion . "', profesion = '" . $profesion . "',observaciones = '" . $observaciones . "' WHERE DUI = '" . $_POST['dui'] . "'";
$conn->execQuery($stmn);

$tmp_name = $_FILES['imagen']['tmp_name'];
$tipo_archivo = $_FILES['imagen']['type'];

$contained_binary = addslashes(fread(fopen($tmp_name,"rb"), $_FILES['imagen']['size']));
$binary_name = $_FILES['imagen']['name'];
$stmn2 = "SELECT MAX(correlativo) FROM documento WHERE DUI='" . $_POST['dui'] . "'";
$resultado = $conn->execQueryO($stmn2);
$max_correlativo = $resultado->fetch_assoc();
$correlativo = $max_correlativo['MAX(correlativo)'] + 1;

$d = new Documento();
if(strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "pdf")) {

                $d->setDui($_POST['dui']);
                $d->setCorrelativo($correlativo);
                $d->setNombre($binary_name);
                $d->setArchivo($contained_binary);
                $d->setDescripcion($_POST['descripcionImagen']);
            }

$dui= $d->getDui();
$correlativo = $d->getCorrelativo();
$nombre = $d->getNombre();
$archivo = $d->getArchivo();
$descripcion = $d->getDescripcion();
if (!(empty($nombre))) {
	$stmn2  = "INSERT INTO documento(DUI, correlativo, nombre_archivo, archivo, descripcion) values('" . $dui . "', '" . $correlativo . "','" . $nombre . "', '" . $archivo . "','" . $descripcion . "')";
$conn->execQuery($stmn2);
}

//Objetos bitacora
$b = new Bitacora();
$controladorBitacora = new Bitacora();
$accion = "El usuario ".$_SESSION["userName"]." modifico el cliente con dui: " . $_POST['dui'];
$id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
$b->setId_bitacora($id_bitacora);
$b->setId_usuario($_SESSION["id_usuario"]);
$b->setFecha(date('Y-m-d h:i:s'));
$b->setAccion($accion);
$controladorBitacora->agregar($b);
header('Location: webClientes.php');
