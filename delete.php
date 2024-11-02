<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
$stmt->bindParam(':id', $id);
if ($stmt->execute()) {
    echo json_encode(["message" => "Task deleted"]);
} else {
    echo json_encode(["error" => "Could not delete task"]);
}
?>
