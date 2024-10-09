


<?php 

include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    
    $is_nsfw = isset($_POST['is_nsfw']) ? 1 : 0;

    $parent_id = $_POST['parent_id'] ?? null;

    $category_id = $_POST['category_id'] ?? '';

    if (empty($title) || empty($content)){
        echo "Título e conteúdo são obrigatórios";
        exit;
    }

    try{
        $query = "INSERT INTO posts (title, content, is_nsfw, parent_id, category_id, created_at) VALUES (:title, :content, :is_nsfw, :parent_id, :category_id, NOW())";

        $stmt = $db ->prepare($query);

        $stmt->bindParam(':title', $title);

        $stmt->bindParam(':content', $content);

        $stmt->bindParam(':is_nsfw', $is_nsfw, PDO::PARAM_INT);

        $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);

        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        if ( $stmt->execute() ){
            echo 'Post criado com sucesso!';
        } else{
            echo 'Erro ao criar o post.';
        }
    } catch(PDOException $e){
        echo 'Erro no banco de dados: ' . $e->getMessage();
    }
} else{
    echo 'Método de envio inválido';
}

?>