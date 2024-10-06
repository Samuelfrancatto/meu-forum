<?php 

include "connect.php";

// Pega o ID da categoria
$category_id = isset($_GET["category_id"]) ? intval($_GET["category_id"]) : 0;

// Pega o ID do post
$post_id = isset($_GET["post_id"]) ? intval($_GET["post_id"]) : 0;

$response = [];

// Se houver um post_id, busque o post específico
if ($post_id > 0) {
    $query_thread = "SELECT * FROM posts WHERE id = :post_id";
    $stmt = $db->prepare($query_thread);
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
    $stmt->execute();

    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    $response['main_post'] = $post; // Armazena o post específico
}

// Se houver um category_id, busque os posts dessa categoria
if ($category_id > 0) {
    $query = "SELECT * FROM posts WHERE category_id = :category_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $response['posts'] = $posts; // Armazena os posts da categoria
}

// Retorna o JSON com ambas as partes
echo json_encode($response);
?>
