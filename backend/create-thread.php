


<?php 

include "connect.php";

function verifyDoublePost($title, $content, $db){
    $query = "SELECT content FROM posts WHERE title = :title ORDER BY created_at DESC LIMIT 1";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->execute();
    $lastPost = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($lastPost && $lastPost['content'] === $content){
        return false;
    }

    return true;
}

function generateUserId($db){
    do{
        $user_id = uniqid();
        $query = 'SELECT COUNT(*) FROM posts WHERE user_id = :user_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $exists = $stmt->fetchColumn();
    } while($exists > 0);

    return $user_id;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    $is_nsfw = isset($_POST['is_nsfw']) ? 1 : 0;

    $category_id = $_POST['category_id'] ??'';


    if (empty($title) || empty($content)) {
        echo 'Título e conteúdo são obrigatórios';
        exit;
    }

    try{

        if (!verifyDoublePost($title, $content, $db)){
            echo 'Post duplicado. Tente enviar um conteúdo diferente.';
            exit;
        }

        $user_id = generateUserId($db);


        $query = "INSERT INTO posts (title, content, is_nsfw, category_id, user_id, created_at) VALUES (:title, :content, :is_nsfw, :category_id, :user_id, NOW())";

        $stmt = $db->prepare("$query");

        $stmt->bindParam(':title', $title);

        $stmt->bindParam(':content', $content);

        $stmt->bindParam(':is_nsfw', $is_nsfw, PDO::PARAM_INT);

        $stmt->bindParam(':user_id', $user_id);

        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo 'Post criado com sucesso!';


            echo "<script>localStorage.setItem('user_id', '$user_id');</script>";
        } else {
            echo 'Erro ao criar o post.';
        }

    } catch(PDOException $e){
        echo 'Erro no banco de dados: ' . $e->getMessage();
    }

} else{
    echo 'Método de envio inválido';
}




?>