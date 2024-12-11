<?php
if (isset($_COOKIE['username'])) {
    $name = $_COOKIE['username'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];
    
    setcookie('username', $username, time() + 48 * 60 * 60, "/"); 
    
    header('Location: reto.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reto Diario</title>
</head>
<body>
    <h1>Bienvenido al juego de las preguntas diarias</h1>
    <form method="POST">
        <p>
            <label for="username">¿Puedes indicarme tu nombre?</label>
        </p>
        <input type="text" name="username" placeholder="tu nombre..." required>
        <button type="submit">Empezar</button>
    </form>
</body>
</html>
