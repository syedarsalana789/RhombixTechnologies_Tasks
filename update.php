<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$text = $data['text'];
$completed = $data['completed'];

$stmt = $pdo->prepare("UPDATE tasks SET text = :text, completed = :completed WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->bindParam(':text', $text);
$stmt->bindParam(':completed', $completed, PDO::PARAM_BOOL);
if ($stmt->execute()) {
    echo json_encode(["message" => "Task updated"]);
} else {
    echo json_encode(["error" => "Could not update task"]);
}
?>
