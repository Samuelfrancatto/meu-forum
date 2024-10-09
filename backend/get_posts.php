<?php 

include "connect.php";

// Captura o ID da categoria da URL
$category_id = isset($_GET["category_id"]) ? intval($_GET["category_id"]) : 0;

if ($category_id > 0) {
    // Consulta para obter todos os posts da categoria
    $query = "SELECT * FROM posts WHERE category_id = :category_id AND parent_id IS NULL";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Se não houver posts, retorna um array vazio
    echo json_encode($posts);
} else {
    echo json_encode(array("error" => "ID da categoria inválido"));
}
?>
