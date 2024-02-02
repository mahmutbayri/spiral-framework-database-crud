<?php

namespace App\Endpoint\Web;

use Cycle\Database\DatabaseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class EditTaskController implements SingletonInterface
{
    use PrototypeTrait;

    private readonly DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    #[Route(route: '/tasks/<id:\d+>/edit', name: 'tasks.edit', methods: 'GET')]
    public function index(ServerRequestInterface $request): string
    {
        $id = $request->getAttribute('matches')['id'];

        $rows = $this->db
            ->query('SELECT * FROM tasks WHERE id = ?', [$id])
            ->fetchAll();

        return $this->views->render('tasks/edit', [
            'task' => $rows[0],
        ]);
    }
}
