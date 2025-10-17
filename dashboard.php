<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Sistema Escolar Premium</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <h1>Painel do Administrador</h1>
        <div class="user-info">
            <span>Bem-vindo, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>!</span>
            <a href="logout.php">Sair</a>
        </div>
    </header>

    <main class="container">
        <form action="relatorio.php" method="POST" id="form-turma">
            <h2 class="form-title">Cadastro de Notas e Frequência</h2>
            
            <div class="input-group">
                <label for="nome_escola">Nome da Escola</label>
                <input type="text" id="nome_escola" name="nome_escola" required>
            </div>
            
            <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #eee;">

            <div id="alunos-container">
                <div class="aluno-entry">
                    <h4>Aluno 1</h4>
                    <div class="input-group">
                        <label>Nome do Aluno</label>
                        <input type="text" name="alunos[0][nome]" required>
                    </div>
                    <div class="input-group-row">
                        <div class="input-group">
                            <label>Nota 1</label>
                            <input type="number" step="0.1" min="0" max="10" name="alunos[0][nota1]" required>
                        </div>
                        <div class="input-group">
                            <label>Nota 2</label>
                            <input type="number" step="0.1" min="0" max="10" name="alunos[0][nota2]" required>
                        </div>
                        <div class="input-group">
                            <label>Nota 3</label>
                            <input type="number" step="0.1" min="0" max="10" name="alunos[0][nota3]" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>Percentual de Frequência (%)</label>
                        <input type="number" step="1" min="0" max="100" name="alunos[0][frequencia]" required>
                    </div>
                </div>
            </div>
            
            <div class="button-group">
                <button type="button" id="add-aluno-btn" class="btn btn-secondary">Adicionar Outro Aluno</button>
                <button type="submit" class="btn btn-primary">Gerar Relatório da Turma</button>
            </div>
        </form>
    </main>
    
    <script src="script.js"></script>
</body>
</html>