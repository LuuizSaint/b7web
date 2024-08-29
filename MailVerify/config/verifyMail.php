<?php

function verify($token) {
    function verifyUser($token) {
    global $pdo; // Supondo que $pdo é sua conexão PDO com o banco de dados
    
    // Buscar o usuário com o token fornecido
    $stmt = $pdo->prepare("SELECT * FROM users WHERE token = ? AND is_verified = 0");
    $stmt->execute([$token]);
    
    if ($stmt->rowCount() > 0) {
        // Atualizar o status para verificado
        $stmt = $pdo->prepare("UPDATE users SET is_verified = 1, token = NULL WHERE token = ?");
        $stmt->execute([$token]);
        
        echo "Conta verificada com sucesso!";
    } else {
        echo "Token inválido ou já utilizado.";
    }
}
}

if(isset($_GET['token'])) {
    $token = verify($_GET['token']);
}

?>