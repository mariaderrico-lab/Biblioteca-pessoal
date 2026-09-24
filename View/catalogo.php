<?php
require __DIR__ . '/layout.php';
headerPagina('Catálogo');
?>
<section class="cabecalho-pagina">
    <div>
        <p class="rotulo">CATÁLOGO DE LEITURA</p>
        <h1>Meus livros</h1>
    </div>

    <a class="botao botao-principal" href="index.php?pagina=cadastro">
        Adicionar livro
    </a>
</section>
<nav class="filtros">
    <a class="filtro <?= !$status ? 'filtro-ativo' : '' ?>" href="index.php">Todos</a>
    <a class="filtro <?= $status === 'quero_ler' ? 'filtro-ativo' : '' ?>" href="index.php?status=quero_ler">Quero ler</a>
    <a class="filtro <?= $status === 'lendo' ? 'filtro-ativo' : '' ?>" href="index.php?status=lendo">Lendo</a>
    <a class="filtro <?= $status === 'lido' ? 'filtro-ativo' : '' ?>" href="index.php?status=lido">Lido</a>
</nav>
<section class="lista-livros">
    <?php if (!$livros): ?>
        <div class="vazio">
            <h2>Nenhum livro encontrado</h2>
            <p>Adicione seu primeiro livro ao catálogo.</p>
        </div>
    <?php endif; ?>

    <?php foreach ($livros as $item): ?>
        <article class="card">
            <div class="cabecalho-card">
                <div>
                    <h2><?= escapar($item['titulo']) ?></h2>
                    <p class="autor"><?= escapar($item['autor']) ?></p>
                </div>
            </div>

            <div class="livro-info">
                <span>Gênero: <?= escapar($item['genero'] ?: 'Não informado') ?></span>
                <span class="nota">
                    <?= escapar(notaFormatada($item['nota'] === null ? null : (int) $item['nota'])) ?>
                </span>
            </div>

            <div class="livro-acoes">
                <a class="botao" href="index.php?pagina=detalhes&id=<?= $item['id'] ?>">Detalhes</a>
                <a class="botao" href="index.php?pagina=editar&id=<?= $item['id'] ?>">Editar</a>

                <form method="post">
                    <input type="hidden" name="acao" value="excluir">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button class="botao botao-excluir" onclick="return confirm('Tem certeza de que deseja excluir o livro?')">
                        Excluir
                    </button>
                </form>
            </div>

            <div class="acoes-livro">
                <form method="post">
                    <input type="hidden" name="acao" value="status">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">

                    <label>
                        Status
                        <select name="status" onchange="this.form.submit()">
                            <option value="quero_ler" <?= $item['status'] === 'quero_ler' ? 'selected' : '' ?>>Quero ler</option>
                            <option value="lendo" <?= $item['status'] === 'lendo' ? 'selected' : '' ?>>Lendo</option>
                            <option value="lido" <?= $item['status'] === 'lido' ? 'selected' : '' ?>>Lido</option>
                        </select>
                    </label>
                </form>

                <?php if ($item['status'] !== 'quero_ler'): ?>
                    <form method="post">
                        <input type="hidden" name="acao" value="avaliar">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">

                        <label>
                            Nota
                            <select name="nota" onchange="this.form.submit()">
                                <option value="">Avaliar</option>
                                <?php for ($nota = 0; $nota <= 5; $nota++): ?>
                                    <option value="<?= $nota ?>" <?= (string) $item['nota'] === (string) $nota ? 'selected' : '' ?>>
                                        <?= $nota ?> estrelas
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </label>
                    </form>
                <?php endif; ?>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<?php footerPagina(); ?>