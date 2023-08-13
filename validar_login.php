<?php
session_start();

$servidor = "dpg-cjbuccrbq8nc7381dmpg-a.oregon-postgres.render.com";
$baseDatos = "programacionweb2db";
$usuario = "programacionweb2db_user";
$contrasena = "5yj5k2v4Svup9dQyVe2RwQmmE285JAAD";

// Cadena de conexión para PDO
$origen = "pgsql:host=$servidor;dbname=$baseDatos;";
$opciones = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($origen, $usuario, $contrasena, $opciones);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$IDUsuario = $_POST['IDUsuario'];
$password = $_POST['password'];

$sentencia = $pdo->prepare("SELECT * FROM usuarios WHERE idusuario = ? AND password = ?");
$sentencia->execute([$IDUsuario, $password]);

$usuario = $sentencia->fetch();

if ($usuario && isset($usuario['nombre'], $usuario['apellidopaterno'], $usuario['apellidomaterno'], $usuario['tipousuario'])) {
    $nombre = $usuario['nombre'];
    $apellidoPaterno = $usuario['apellidopaterno'];
    $apellidoMaterno = $usuario['apellidomaterno'];
    $tipoUsuario = $usuario['tipousuario'];

    $_SESSION['tipoUsuario'] = $tipoUsuario;
    $_SESSION['mensaje'] = "¡Bienvenido $nombre $apellidoPaterno $apellidoMaterno! ¡Has ingresado como $tipoUsuario!";

    header("Location: index.php");
    exit;
} else {
    echo "Usuario no registrado";
}
?>
