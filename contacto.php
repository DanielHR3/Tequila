<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tequila_contacto";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$form_submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreapellido = $conn->real_escape_string($_POST['nombreapellido']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $mensaje = $conn->real_escape_string($_POST['mensaje']);
    $contacto_preferencia = $conn->real_escape_string($_POST['contacto']);
    $horario_preferencia = $conn->real_escape_string($_POST['horario']);
    $novedades = isset($_POST['novedades']) ? 1 : 0;

    $sql = "INSERT INTO contactos (nombreapellido, correo, telefono, mensaje, contacto_preferencia, horario_preferencia, novedades)
            VALUES ('$nombreapellido', '$correo', '$telefono', '$mensaje', '$contacto_preferencia', '$horario_preferencia', $novedades)";

    if ($conn->query($sql) === TRUE) {
        $form_submitted = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contacto - Livergood Ltd - Tequila Premium</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="caja">
            <h1><img src="imagenes/logot.png" alt="Logo de Livergood Ltd"></h1>
            <nav>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="productos.html">Productos</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="confirmacion-main">
        <?php if ($form_submitted): ?>
        <!-- Mostrar mensaje de confirmación -->
        <div class="confirmacion">
            <h2 class="confirmacion-titulo">Mensaje enviado. Gracias por contactarnos.</h2>
            <button onclick="regresarAlInicio()" class="confirmacion-submit">Regresar al Inicio</button>
        </div>
        <?php else: ?>
        <!-- Si no hay formulario enviado, mostrar un mensaje de error -->
        <div class="confirmacion">
            <h2 class="confirmacion-titulo">Error al enviar el formulario. Por favor, inténtalo de nuevo.</h2>
            <button onclick="regresarAlInicio()" class="confirmacion-submit">Regresar al Inicio</button>
        </div>
        <?php endif; ?>
    </main>

    <footer>
        <img src="imagenes/logo-blancot.png" alt="Logo de Livergood Ltd">
        <p class="copyright">&copy; Copyright Livergood Ltd - 2024</p>
    </footer>

    <script>
        function regresarAlInicio() {
            window.location.href = 'index.html'; // Redirige al usuario a la página de inicio
        }
    </script>
</body>

</html>
