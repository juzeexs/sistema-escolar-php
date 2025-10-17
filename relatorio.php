<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['alunos'])) {
    header('Location: dashboard.php');
    exit;
}

$nome_escola = htmlspecialchars($_POST['nome_escola']);
$dados_alunos = $_POST['alunos'];

$turma = [];
foreach ($dados_alunos as $aluno_data) {
    if (empty($aluno_data['nome'])) continue;

    $turma[] = [
        'nome' => htmlspecialchars($aluno_data['nome']),
        'notas' => [
            (float) ($aluno_data['nota1'] ?? 0),
            (float) ($aluno_data['nota2'] ?? 0),
            (float) ($aluno_data['nota3'] ?? 0)
        ],
        'frequencia' => (int) ($aluno_data['frequencia'] ?? 0)
    ];
}

function calcularMedia(array $notas): float {
    if (count($notas) === 0) {
        return 0.0;
    }
    return array_sum($notas) / count($notas);
}

function situacaoPresenca(int $percentualFrequencia, int $minimoRequerido = 75): string {
    return $percentualFrequencia >= $minimoRequerido ? 'Regular' : 'Insuficiente';
}

function statusFinal(float $media, int $frequencia, float $mediaMinima = 7.0, int $frequenciaMinima = 75): string {
    if ($media >= $mediaMinima && $frequencia >= $frequenciaMinima) {
        return 'Aprovado';
    }
    return 'Reprovado';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório da Turma - Sistema Escolar Premium</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <h1>Relatório da Turma</h1>
        <div class="user-info">
            <span>Escola: <strong><?php echo $nome_escola; ?></strong></span>
            <a href="dashboard.php" style="color: var(--primary-color);">Voltar ao Painel</a>
            <a href="logout.php">Sair</a>
        </div>
    </header>

    <main class="container">
        <h2 class="form-title">Resultado Final da Turma</h2>
        <table class="report-table">
            <thead>
                <tr>
                    <th>Nome do Aluno</th>
                    <th>Média Final</th>
                    <th>Frequência</th>
                    <th>Situação de Presença</th>
                    <th>Status Final</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($turma)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Nenhum dado de aluno para exibir.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($turma as $aluno): ?>
                        <?php
                            $media = calcularMedia($aluno['notas']);
                            $presenca = situacaoPresenca($aluno['frequencia']);
                            $status = statusFinal($media, $aluno['frequencia']);
                            $status_class = ($status === 'Aprovado') ? 'status-aprovado' : 'status-reprovado';
                        ?>
                        <tr>
                            <td><?php echo $aluno['nome']; ?></td>
                            <td><?php echo number_format($media, 2, ',', '.'); ?></td>
                            <td><?php echo $aluno['frequencia']; ?>%</td>
                            <td><?php echo $presenca; ?></td>
                            <td class="<?php echo $status_class; ?>"><?php echo $status; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>