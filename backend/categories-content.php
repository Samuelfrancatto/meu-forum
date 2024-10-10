<?php
include 'connect.php'; // Conexão com o banco de dados

// Consulta para obter categorias e tópicos
try {
    $query = "
        SELECT c.*, t.name AS topic_name
        FROM categories c
        JOIN topics t ON c.topic_id = t.id
        ORDER BY t.id, c.name"; // Ordena por tópico e nome da categoria

    $stmt = $db->prepare($query);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($categories);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
}
?>
