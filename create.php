<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$text = isset($data['text']) ? trim($data['text']) : '';

if ($text) {
    try {
        $stmt = $pdo->prepare("INSERT INTO tasks (text) VALUES (:text)");
        $stmt->bindParam(':text', $text);

        if ($stmt->execute()) {
            echo json_encode([
                "id" => $pdo->lastInsertId(),
                "text" => $text,
                "completed" => false
            ]);
        } else {
            throw new Exception("Database insertion error");
        }
    } catch (Exception $e) {
        error_log("Error in create.php: " . $e->getMessage()); // Log error for debugging
        echo json_encode(["error" => "Could not add task. See server logs."]);
    }
} else {
    echo json_encode(["error" => "No valid text provided"]);
}
?>
