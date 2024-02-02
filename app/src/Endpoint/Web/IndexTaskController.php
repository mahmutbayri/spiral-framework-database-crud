<?php

namespace App\Endpoint\Web;

use Cycle\Database\DatabaseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class IndexTaskController implements SingletonInterface
{
    use PrototypeTrait;

    private readonly DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    #[Route(route: '/tasks', name: 'tasks.index', methods: 'GET')]
    public function index(ServerRequestInterface $request): string
    {
        $rows = $this->db
            ->query('SELECT * FROM tasks')
            ->fetchAll();

        return $this->views->render('tasks/index', [
            'tasks' => $rows
        ]);
    }
}
