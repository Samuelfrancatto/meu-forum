<?php
// Dados de conexão
$host = "sql202.infinityfree.com";
$dbname = "if0_37379606_purpleland";
$username = "if0_37379606";
$password = "o7RL95avfFAZ";

try {
    // Criar uma nova conexão PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Configurar o modo de erro do PDO para exceções
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão estabelecida com sucesso!";
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit; // Encerra o script se a conexão falhar
}
?>
