<?php

require 'database.php';

if (isset($_POST['title'])) {
    $title = $_POST['title'];

    try {
        $stmt = $conn->prepare('INSERT INTO tasks (titles) VALUES (:title)');
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        $tasksId = $conn->lastInsertId();
        echo json_encode(['id' => $tasksId, 'title' => $title, 'completed' => false]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'O título da tarefa é obrigatório']);
}
