<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=daily_notes;charset=utf8mb4', 'root', '',[
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
    ]);

} catch (PDOException $e) {
    echo "Error to connect " . $e->getMessage();
}
