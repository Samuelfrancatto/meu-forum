<?php 

include "connect.php";

// Obter o IP do usuário
$ip = $_SERVER["REMOTE_ADDR"];

$sql = "SELECT * FROM users WHERE user_ip = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$ip]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);



if ($user) {
    // O usuário já existe
    $user_exists = true;
} else {
    // O usuário não existe
    $user_exists = false;

    // Lógica para inserir o usuário no banco de dados se o formulário for enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql_insert = "INSERT INTO users (user_ip) VALUES (?)";
        $stmt_insert = $db->prepare($sql_insert);
        $stmt_insert->execute([$ip]);
        echo "Usuário criado com o IP: " . $ip;
        $user_exists = true; // Atualiza a variável para indicar que o usuário foi criado
    }
}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purple Land</title>
</head>
<body>

<style>
    :root {
        --default-purple: rgb(190, 122, 255);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        position: absolute;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgb(206, 162, 255);
    }

    #welcome-text {
        font-size: 20pt;
        color: white;
        margin-bottom: 20px; /* Espaçamento entre a mensagem e o botão */
    }

    #enter-btn {
        width: 200px;
        height: 50px;
        padding: 0px 10px;
        border-radius: 10px;
        border: none;
        background-color: rgb(145, 3, 228);
        font-size: 20px;
        color: white;
        transition: transform 0.01s ease;
    }

    #enter-btn:active {
        transform: scale(0.9);
    }
</style>

<?php if (!$user_exists): ?>
    <!-- Exibir o formulário se o usuário não existir -->
    <form method="POST" action="">
        <button type="submit" id="enter-btn">Entrar na Purple Land</button>
    </form>
<?php else: ?>
    <!-- Se o usuário já existir, exibir mensagem -->
    <p id="welcome-text">Bem-vindo de volta! Você já está registrado.</p>
    <form method="GET" action="../forum/home/home.html">
        <button type="submit" id="enter-btn">Entrar na Purple Land</button>
    </form>
<?php endif; ?>

</body>
</html>
