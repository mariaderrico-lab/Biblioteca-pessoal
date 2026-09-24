<?php
require __DIR__ . '/layout.php';
headerPagina('Cadastrar livro');
?>

<section class="formulario">
    <h1>Adicionar livro</h1>

    <form method="post">
        <input type="hidden" name="acao" value="cadastrar">

        <label class="campo">
            Título
            <input name="titulo" required>
        </label>

        <label class="campo">
            Autor
            <input name="autor" required>
        </label>

        <label class="campo">
            Gênero
            <input name="genero">
        </label>

        <label class="campo">
            Status
            <select name="status" required>
                <option value="quero_ler">Quero ler</option>
                <option value="lendo">Lendo</option>
                <option value="lido">Lido</option>
            </select>
        </label>

        <div class="formulario-acoes">
            <a class="botao" href="index.php">Cancelar</a>
            <button class="botao botao-principal">Cadastrar</button>
        </div>
    </form>
</section>

<?php footerPagina(); ?>
