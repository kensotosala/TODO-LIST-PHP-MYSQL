<?php

try {
    $conn = new PDO('mysql:host=localhost;port=3308;dbname=apptododb', 'root', 'kensotosala');
} catch (PDOException $e) {
    echo "Error de conexión";
}


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $completado = (isset($_POST['completado'])) ? 1 : 0;

    $sql = "UPDATE tareas SET completado=? WHERE id=?";
    $sentencia = $conn->prepare($sql);
    $sentencia->execute([$completado, $id]);
}


// --- Agregar tarea --- 
// Verifica si el formulario ha sido enviado con el botón "Agregar tarea".
if (isset($_POST['agregar_tarea'])) {
    // Obtiene el texto de la tarea del formulario.
    $tarea = $_POST['tarea'];
    // Crea una consulta SQL para insertar la tarea en la tabla `tareas`.
    $sql = 'INSERT INTO tareas (tarea) VALUE(?)';
    // Prepara la consulta para ser ejecutada.
    $sentencia = $conn->prepare($sql);
    // Ejecuta la consulta y agrega la tarea a la tabla.
    $sentencia->execute([$tarea]);
}

// --- Borrar tarea ---
// Verifica si la variable `$_GET['id']` está definida.
// Si está definida, se asume que el usuario ha hecho clic en el enlace para eliminar la tarea.
if (isset($_GET['id'])) {
    // Obtiene el ID de la tarea que se va a eliminar del parámetro `$_GET['id']`.
    $id = $_GET['id'];
    // Crea una consulta SQL para eliminar la tarea de la tabla `tarea`.
    $sql = "DELETE FROM tareas WHERE id=?";
    // Prepara la consulta para ser ejecutada.
    $sentencia = $conn->prepare($sql);
    // Ejecuta la consulta y elimina la tarea de la tabla.
    $sentencia->execute([$id]);
}

$sql = "SELECT * FROM tareas"; // Almacena la consulta de SQL
$registros = $conn->query($sql); // Ejecuta la consulta y guarda el resultado en la variable
