<?php
if (!isset($_COOKIE['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_COOKIE['username'];

include 'questions.php';

$fecha = date('d-m-Y');
$tema_del_dia = "Historia"; 

$question = isset($dailyQuestions[$fecha]) ? $dailyQuestions[$fecha] : null;

if (!$question) {
    echo "<p>No hay preguntas para el día de hoy.</p>";
    exit();
}

session_start();
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

$current_question = isset($_GET['questions']) ? (int)$_GET['questions'] : 0;
$total_questions = count($question);

if ($current_question >= $total_questions) {
    echo "<p>¡Felicidades, has completado el reto! Puntuación total: " . $_SESSION['score'] . " puntos.</p>";
    session_destroy();
    exit();
}

$questions = $question[$current_question];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reto Diario</title>
</head>
<body>
    <h1>Hola, <?php echo $username; ?></h1>
    <h2>Fecha: <?php echo $fecha; ?></h2>
    <h2>Tema del día: <?php echo $tema_del_dia; ?></h2>

    <p>Pregunta <?php echo $current_question + 1; ?> de <?php echo $total_questions; ?></p>
    <p><?php echo $dailyQuestions[1]; ?></p>

    <form method="POST">
        <?php foreach ($dailyQuestions[1] as $key => $option): ?>
            <label>
                <input type="radio" name="answer" value="<?php echo $key; ?>">
                <?php echo ($option); ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Responder</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answers'])) {
        $answer = $_POST['answers'];
        if ($answer == $dailyQuestions['correct']) {
            $_SESSION['score']++;
            echo "<p>COMPLETADO</p> 
            <h3>Ya has participado este día con una puntuación de " . $_SESSION['score'] . " puntos.</h3>";
            header('Location: reto.php?q=' . ($current_question + 1));
            exit();
        } else {
            echo "<p>FALLO</p>
            <h3>Ya has participado este día con una puntuación de " . $_SESSION['score'] . " puntos.</h3>";
            session_destroy();
            exit();
        }
    }
    ?>
</body>
</html>
