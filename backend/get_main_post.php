<?php 

include "connect.php";

// Captura o parâmetro post_id da URL
$post_id = isset($_GET["post_id"]) ? intval($_GET["post_id"]) : 0;

if ($post_id > 0) {
    // Consulta para obter o post específico
    $query_thread = "SELECT * FROM posts WHERE id = :post_id";
    $stmt = $db->prepare($query_thread);
    $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
    $stmt->execute();

    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se o post não for encontrado, retorna erro
    if ($post) {
        echo json_encode($post);
    } else {
        echo json_encode(array("error" => "Post não encontrado"));
    }

} else {
    echo json_encode(array("error" => "ID do post inválido"));
}
?>
