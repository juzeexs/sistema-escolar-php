<?php
session_start();
define('USUARIO_VALIDO', 'admin');
define('SENHA_VALIDA', 'escola123');

$mensagem_erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if (empty($usuario) || empty($senha)) {
        $mensagem_erro = 'Por favor, preencha todos os campos.';
    } else {
        if ($usuario === USUARIO_VALIDO && $senha === SENHA_VALIDA) {
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuario;
            header('Location: dashboard.php');
            exit;
        } else {
            $mensagem_erro = 'Credenciais inválidas. Tente novamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Escolar Premium</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form action="index.php" method="POST" class="login-form">
            <h2>Sistema Escolar</h2>
            <p>Acesse sua conta de administrador.</p>
            
            <?php if (!empty($mensagem_erro)): ?>
                <div class="mensagem-erro">
                    <?php echo $mensagem_erro; ?>
                </div>
            <?php endif; ?>

            <div class="input-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite 'admin'" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite 'escola123'" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</body>
</html>