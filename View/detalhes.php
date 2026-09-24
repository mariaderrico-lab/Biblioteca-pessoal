<?php
require __DIR__ . '/layout.php';
headerPagina('Detalhes do livro');
?>

<section class="detalhes-livro">
    <p class="rotulo">DETALHES DO LIVRO</p>
    <h1><?= escapar($livro['titulo']) ?></h1>

    <dl class="informacoes-livro">
        <div>
            <dt>Autor</dt>
            <dd><?= escapar($livro['autor']) ?></dd>
        </div>

        <div>
            <dt>Gênero</dt>
            <dd><?= escapar($livro['genero'] ?: 'Não informado') ?></dd>
        </div>

        <div>
            <dt>Status</dt>
            <dd><span class="status"><?= escapar(nomeStatus($livro['status'])) ?></span></dd>
        </div>

        <div>
            <dt>Nota</dt>
            <dd class="nota">
                <?= escapar(notaFormatada($livro['nota'] === null ? null : (int) $livro['nota'])) ?>
            </dd>
        </div>
    </dl>

    <div class="livro-acoes">
        <a class="botao" href="index.php">Voltar ao catálogo</a>
        <a class="botao botao-principal" href="index.php?pagina=editar&id=<?= $livro['id'] ?>">
            Editar livro
        </a>
    </div>
</section>

<?php footerPagina(); ?>