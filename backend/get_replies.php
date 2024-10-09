

<?php 

include "connect.php";

$parent_id = $_GET['parent_id'] ?? '';

if ($parent_id){

    try{
        $query = "SELECT * FROM posts WHERE parent_id = :parent_id";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":parent_id", $parent_id, PDO::PARAM_INT);

        if ( $stmt->execute() ){
            $responses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else{
            echo 'Falha na execução da consulta.';
        }
    
        
    
        header('Content-Type: application/json');
        echo json_encode($responses);
    } catch(PDOException $e){
        echo json_encode(['error'=> 'Erro no banco de dados: ' . $e->getMessage()]);
    }
   
}else{
    echo json_encode(['error'=> 'ID do post principal não fornecido.']);
}

?>