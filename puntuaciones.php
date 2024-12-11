<?php
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
    exit();
}

session_start();

if (!isset($_SESSION['scores'])) {
    $_SESSION['scores'] = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntuaciones</title>
</head>
<body>
    <h1>Tu historial de puntuaciones, <?php echo htmlspecialchars($_COOKIE['username']); ?>:</h1>
    
    <?php if (empty($_SESSION['score'])): ?>
        <p>No tienes puntuaciones registradas.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($_SESSION['score'] as $score): ?>
                <li><?php echo $fecha;?> : <?php echo $score; ?> puntos</li>
            <?php endforeach; ?>
        </ul>
        <p>Puntuación total: <?php echo array_sum($_SESSION['score']); ?> puntos</p>
    <?php endif; ?>
    
    <form action="finalizar.php" method="POST">
        <button type="submit">Finalizar participación</button>
    </form>
</body>
</html>
