<?php
$enviado = false;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if ($nombre === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $mensaje === '') {
        $error = 'Revisa los campos: todos son obligatorios y el email debe ser válido.';
    } else {
        $pdo = new PDO(
            sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", getenv('DB_HOST'), getenv('DB_NAME')),
            getenv('DB_USER'),
            getenv('DB_PASS'),
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $stmt = $pdo->prepare(
            "INSERT INTO mensajes_contacto (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)"
        );
        $stmt->execute(['nombre' => $nombre, 'email' => $email, 'mensaje' => $mensaje]);
        $enviado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto · CaféAroma</title>
  <link rel="stylesheet" href="/estilos.css">
</head>
<body>
  <header>
    <h1><a href="/">☕ CaféAroma</a></h1>
    <nav>
      <a href="/catalogo.php">Catálogo</a>
      <a href="/contacto.php">Contacto</a>
    </nav>
  </header>

  <main>
    <h2>Contacto</h2>

    <?php if ($enviado): ?>
      <p class="aviso">¡Gracias! Hemos recibido tu mensaje.</p>
    <?php elseif ($error): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
      <input name="nombre" placeholder="Nombre" required>
      <input name="email" type="email" placeholder="Email" required>
      <textarea name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
      <button type="submit">Enviar</button>
    </form>
  </main>

  <footer>Los mensajes se guardan en la tabla mensajes_contacto</footer>
</body>
</html>
