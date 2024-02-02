<?php

namespace App\Endpoint\Web;

use Cycle\Database\DatabaseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class ShowTaskController implements SingletonInterface
{
    use PrototypeTrait;

    private readonly DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    #[Route(route: '/tasks/<id:\d+>', name: 'tasks.show', methods: 'GET')]
    public function index(ServerRequestInterface $request): string
    {
        $id = $request->getAttribute('matches')['id'];

        $rows = $this->db
            ->query('SELECT * FROM tasks WHERE id = ?', [$id])
            ->fetchAll();

        return $this->views->render('tasks/show', [
            'task' => $rows[0],
        ]);
    }
}
