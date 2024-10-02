


<?php 

include "connect.php";

$category_id = isset($_GET["category_id"]) ? intval($_GET["category_id"]) : 0;

if ($category_id > 0) {
    $query = "SELECT * FROM posts WHERE category_id = :category_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode($posts);
} else {
    echo json_encode(array("error"=> "Erro"));
}

?>