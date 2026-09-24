<?php

function escapar(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

function nomeStatus(string $status): string
{
    return [
        'quero_ler' => 'Quero ler',
        'lendo' => 'Lendo',
        'lido' => 'Lido'
    ][$status] ?? $status;
}

function notaFormatada(?int $nota): string
{
    if ($nota === null) {
        return 'Não avaliado';
    }

    return $nota . ' de 5';
}

function headerPagina(string $titulo): void
{
    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escapar($titulo) ?> | MyBibli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="templates/css/style.css">
</head>
<body>
    <header class="header">
        <div class="pagina">
            <a class="marca" href="index.php">MyBibli</a>
        </div>
    </header>

    <main class="pagina">
        <?php if (!empty($GLOBALS['mensagemSucesso'])): ?>
            <div class="alerta alerta-sucesso">
                <?= escapar($GLOBALS['mensagemSucesso']) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($GLOBALS['mensagemErro'])): ?>
            <div class="alerta alerta-erro">
                <?= escapar($GLOBALS['mensagemErro']) ?>
            </div>
        <?php endif; ?>
    <?php
}

function footerPagina(): void
{
    ?>
    </main>
</body>
</html>
    <?php
}