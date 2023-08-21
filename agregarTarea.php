<?php

try {
    $conn = new PDO('mysql:host=localhost;port=3308;dbname=apptododb', 'root', 'kensotosala');
    echo "Conexión establecida...";
} catch (PDOException $e) {
    echo "Error de conexión:" . $e->getMessage();
}
