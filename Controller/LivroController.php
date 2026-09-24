<?php
namespace Controller;
use Model\Livro;
class LivroController
{
    private Livro $livro;
    private array $statusPermitidos = ['quero_ler', 'lendo', 'lido'];
    public function __construct() {
        $this->livro = new Livro();
    }
    public function cadastrar(): void {
        $titulo = trim((string) filter_input(INPUT_POST, 'titulo'));
        $autor = trim((string) filter_input(INPUT_POST, 'autor'));
        $genero = trim((string) filter_input(INPUT_POST, 'genero'));
        $status = (string) filter_input(INPUT_POST, 'status');

        if ($titulo === '' || $autor === '' || !$this->statusValido($status)) {
            $this->mensagem('erro', 'Preencha título, autor e um status válido.');
            $this->redirecionar('cadastro');
        }
        $this->livro->salvar($titulo, $autor, $genero, $status);
        $this->mensagem('sucesso', 'Livro cadastrado com sucesso.');
        $this->redirecionar('catalogo');
    }
    public function atualizar(): void {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $titulo = trim((string) filter_input(INPUT_POST, 'titulo'));
        $autor = trim((string) filter_input(INPUT_POST, 'autor'));
        $genero = trim((string) filter_input(INPUT_POST, 'genero'));

        if (!$id || $titulo === '' || $autor === '' || !$this->livro->buscarPorId($id)) {
            $this->mensagem('erro', 'Dados do livro inválidos.');
            $this->redirecionar('catalogo');
        }

        $this->livro->atualizar($id, $titulo, $autor, $genero);
        $this->mensagem('sucesso', 'Livro atualizado com sucesso.');
        $this->redirecionar('catalogo');
    }
    public function excluir(): void {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$id || !$this->livro->buscarPorId($id)) {
            $this->mensagem('erro', 'Livro não encontrado.');
            $this->redirecionar('catalogo');
        }
        $this->livro->excluir($id);
        $this->mensagem('sucesso', 'Livro excluído com sucesso.');
        $this->redirecionar('catalogo');
    }
    public function alterarStatus(): void {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $status = (string) filter_input(INPUT_POST, 'status');
        if (!$id || !$this->statusValido($status) || !$this->livro->buscarPorId($id)) {
            $this->mensagem('erro', 'Status ou livro inválido.');
            $this->redirecionar('catalogo');
        }
        $this->livro->alterarStatus($id, $status);
        $this->mensagem('sucesso', 'Status alterado com sucesso.');
        $this->redirecionar('catalogo');
    }
    public function avaliar(): void {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nota = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_INT);
        $livro = $id ? $this->livro->buscarPorId($id) : false;

        if (!$livro || $nota === false || $nota < 0 || $nota > 5) {
            $this->mensagem('erro', 'Nota ou livro inválido.');
            $this->redirecionar('catalogo');
        }
        if ($livro['status'] === 'quero_ler') {
            $this->mensagem('erro', 'Livros que você quer ler não podem ser avaliados.');
            $this->redirecionar('catalogo');
        }
        $this->livro->avaliar($id, $nota);
        $this->mensagem('sucesso', 'Avaliação salva com sucesso.');
        $this->redirecionar('catalogo');
    }
    public function listar(?string $status = null): array {
        return $this->livro->listar($this->statusValido($status) ? $status : null);
    }
    public function detalhes(int $id): array|false {
        return $this->livro->buscarPorId($id);
    }
    private function statusValido(?string $status): bool {
        return in_array($status, $this->statusPermitidos, true);
    }
    private function mensagem(string $tipo, string $texto): void {
        $_SESSION[$tipo] = $texto;
    }
    private function redirecionar(string $pagina): never {
        header('Location: index.php?pagina=' . $pagina);
        exit;
    }
}
