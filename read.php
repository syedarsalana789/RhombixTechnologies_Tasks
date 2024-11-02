<?php
require 'db.php';

try {
    $stmt = $pdo->query("SELECT * FROM tasks ORDER BY id DESC");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tasks);
} catch (Exception $e) {
    error_log("Error in read.php: " . $e->getMessage()); // Log error for debugging
    echo json_encode(["error" => "Could not fetch tasks. See server logs."]);
}
?>
