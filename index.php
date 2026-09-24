<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Controller\LivroController;

$controller = new LivroController();
$pagina = $_GET['pagina'] ?? 'catalogo';
$acao = $_POST['acao'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    match ($acao) {
        'cadastrar' => $controller->cadastrar(),
        'atualizar' => $controller->atualizar(),
        'excluir' => $controller->excluir(),
        'status' => $controller->alterarStatus(),
        'avaliar' => $controller->avaliar(),
        default => header('Location: index.php?pagina=catalogo')
    };
    exit;
}

$status = $_GET['status'] ?? null;
$livros = $controller->listar($status);
$livro = null;

if ($pagina === 'editar' || $pagina === 'detalhes') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $livro = $id ? $controller->detalhes($id) : false;
    if (!$livro) {
        $_SESSION['erro'] = 'Livro não encontrado.';
        header('Location: index.php?pagina=catalogo');
        exit;
    }
}

$mensagemSucesso = $_SESSION['sucesso'] ?? null;
$mensagemErro = $_SESSION['erro'] ?? null;
unset($_SESSION['sucesso'], $_SESSION['erro']);

require __DIR__ . '/View/' . match ($pagina) {
    'cadastro' => 'cadastro.php',
    'editar' => 'editar.php',
    'detalhes' => 'detalhes.php',
    default => 'catalogo.php'
};
