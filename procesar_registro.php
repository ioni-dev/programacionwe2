<?php

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $departamento = $_POST['departamento'];
    $idUsuario = $_POST['IDUsuario'];
    $contrasena = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Verificar que ningún dato esté vacío
    if (empty($nombre) || empty($apellidoPaterno) || empty($idUsuario) || empty($contrasena)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Verificar que la contraseña coincida con la confirmación
    if ($contrasena !== $confirmPassword) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Verificar la longitud y formato de la contraseña
    $patron = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[#,$,-,_,&,%]).{8,}$/";
    if (!preg_match($patron, $contrasena)) {
        echo "La contraseña debe tener al menos 8 caracteres, incluir letras, números y al menos un carácter especial (#,$,-,_,&,%).";
        exit;
    }

    // Verificar que el IDUsuario no exista en la tabla USUARIOS
    $sentenciaBusqueda = $pdo->prepare("SELECT * FROM USUARIOS WHERE IDUsuario = ?");
    $sentenciaBusqueda->execute([$idUsuario]);
    $usuario = $sentenciaBusqueda->fetch();
    if ($usuario) {
        echo "El IDUsuario ya existe.";
        exit;
    }

    // Si todas las validaciones son exitosas, insertar el nuevo usuario en la base de datos
    $sentencia = $pdo->prepare("INSERT INTO USUARIOS (IDUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, Departamento, TipoUsuario, Password) VALUES (?, ?, ?, ?, ?, 'CO', ?)");
    $sentencia->execute([$idUsuario, $nombre, $apellidoPaterno, $apellidoMaterno, $departamento, $contrasena]);

    echo "Registro exitoso!";
}
?>
