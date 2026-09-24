<?php
require __DIR__ . '/layout.php';
headerPagina('Editar livro');
?>

<section class="formulario">
    <h1>Editar livro</h1>

    <form method="post">
        <input type="hidden" name="acao" value="atualizar">
        <input type="hidden" name="id" value="<?= $livro['id'] ?>">

        <label class="campo">
            Título
            <input name="titulo" value="<?= escapar($livro['titulo']) ?>" required>
        </label>

        <label class="campo">
            Autor
            <input name="autor" value="<?= escapar($livro['autor']) ?>" required>
        </label>

        <label class="campo">
            Gênero
            <input name="genero" value="<?= escapar($livro['genero']) ?>">
        </label>

        <div class="formulario-acoes">
            <a class="botao" href="index.php">Cancelar</a>
            <button class="botao botao-principal">Salvar alterações</button>
        </div>
    </form>
</section>

<?php footerPagina(); ?>
