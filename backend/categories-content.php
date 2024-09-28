<?php 

include "connect.php";

// Definir o cabeçalho para JSON
header("Content-Type: application/json");

// Realizar a consulta
$query = "SELECT * FROM categories";
$stmt = $db->query($query);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retornar o JSON sem mensagens adicionais
echo json_encode($categories);

?>
