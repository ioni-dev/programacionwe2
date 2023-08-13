<?php
session_start();
$tipoUsuario = $_SESSION['tipoUsuario'] ?? null;

// Verificar si existe el mensaje en la variable de sesión
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']); // Eliminar el mensaje de la sesión
} else {
    $mensaje = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condominio Torres Tlalpan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php if ($tipoUsuario): ?>
                <li><a href="consultar_pagos.php">Consultar pagos</a></li>
                <?php if ($tipoUsuario == 'AD'): ?>
                    <li><a href="registrar_pagos.php">Registrar pagos</a></li>
                <?php endif; ?>
                <li><a href="salir.php">Salir</a></li>
            <?php else: ?>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header>
        <h1>Condominio Torres Tlalpan</h1>
    </header>
    <main>
        <?php if ($mensaje): ?>
            <div class="mensaje-bienvenida">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <img src="./assets/imagenes/torres_tlalpan.jpg" alt="Imagen de Torres Tlalpan">
        <p>Bienvenido al Condominio Torres Tlalpan, un lugar de tranquilidad y comodidad en el corazón de la ciudad.</p>
    </main>
</body>
</html>
