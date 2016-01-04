<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=TOMO2', 'root', 'root');
} catch (PDOException $e) {
    exit ("Database error...");
}
?>