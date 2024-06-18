<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = new PDO('mysql:host=localhost;dbname=volta-ao-mundo', 'root', '');

    // Verificar se o usuário existe
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE nome = ?');
    $stmt->execute([$_POST['nome']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se a senha está correta
    if ($usuario && password_verify($_POST['senha'], $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];

        // Verificar se o usuário é admin
        if ($usuario['admin'] == 1) {
            header('Location: pagina-admin.php');
            $_SESSION['admin'] = $usuario['admin'];
        } else {
            header('Location: index.php');
        }
        exit;
    } else {
        echo "<script>alert('usuario ou senha incorreto');</script>";
        echo "<script>window.location = 'login.php';</script>";    
    }
}
?>
