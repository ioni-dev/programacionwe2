<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Condómino</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="registro.php">Registrarse</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
        </ul>
    </nav>
    <main>
        <h2>Registro de Condómino</h2>
        <form action="procesar_registro.php" method="post" class="registro-formulario">
            <label for="IDUsuario">ID de Usuario:</label>
            <input type="text" id="IDUsuario" name="IDUsuario" required><br><br>
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" id="apellidoPaterno" name="apellidoPaterno" required><br><br>

            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" id="apellidoMaterno" name="apellidoMaterno"><br><br>

            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento"><br><br>

            <label for="tipoDeUsuario">Tipo de usuario:</label>
            <select id="tipoDeUsuario" name="tipoDeUsuario">
                <option value="CO" selected>Condómino (CO)</option>
            </select>
            <br><br>


            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="confirmPassword">Confirmar Contraseña:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required><br><br>

            <input type="submit" value="Registrar">
        </form>
    </main>
</body>
</html>
