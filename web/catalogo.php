<?php
$pdo = new PDO(
    sprintf("mysql:host=%s;dbname=%s;charset=utf8mb4", getenv('DB_HOST'), getenv('DB_NAME')),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$productos = $pdo->query("SELECT nombre, precio FROM productos WHERE stock > 0 ORDER BY nombre");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo · CaféAroma</title>
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
    <h2>Catálogo</h2>
    <ul class="productos">
      <?php foreach ($productos as $p): ?>
        <li>
          <span><?= htmlspecialchars($p['nombre']) ?></span>
          <strong><?= number_format($p['precio'], 2, ',', '.') ?> €</strong>
        </li>
      <?php endforeach; ?>
    </ul>
  </main>

  <footer>Datos leídos en tiempo real desde MariaDB</footer>
</body>
</html>
