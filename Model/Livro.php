<?php
namespace Model;
use PDO;
class Livro
{
    private PDO $connection;

    public function __construct() {
        $this->connection = Connection::getInstance();
    }

    public function salvar(string $titulo, string $autor, string $genero, string $status): bool {
        $sql = 'INSERT INTO livros (titulo, autor, genero, status, nota) VALUES (?, ?, ?, ?, NULL)';
        return $this->connection->prepare($sql)->execute([$titulo, $autor, $genero, $status]);
    }

    public function listar(?string $status = null): array {
        if ($status !== null) {
            $stmt = $this->connection->prepare('SELECT * FROM livros WHERE status = ? ORDER BY id DESC');
            $stmt->execute([$status]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $this->connection->query('SELECT * FROM livros ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): array|false {
        $stmt = $this->connection->prepare('SELECT * FROM livros WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(int $id, string $titulo, string $autor, string $genero): bool {
        $stmt = $this->connection->prepare('UPDATE livros SET titulo = ?, autor = ?, genero = ? WHERE id = ?');
        return $stmt->execute([$titulo, $autor, $genero, $id]);
    }

    public function excluir(int $id): bool {
        return $this->connection->prepare('DELETE FROM livros WHERE id = ?')->execute([$id]);
    }

    public function alterarStatus(int $id, string $status): bool {
        return $this->connection->prepare('UPDATE livros SET status = ? WHERE id = ?')->execute([$status, $id]);
    }

    public function avaliar(int $id, int $nota): bool {
        return $this->connection->prepare('UPDATE livros SET nota = ? WHERE id = ?')->execute([$nota, $id]);
    }
}
