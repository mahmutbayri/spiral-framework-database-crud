<?php

namespace App\Endpoint\Web;

use Cycle\Database\DatabaseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class DestroyTaskController implements SingletonInterface
{
    use PrototypeTrait;

    private readonly DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    #[Route(route: '/tasks/<id:\d+>', name: 'task.delete', methods: 'DELETE')]
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('matches')['id'];

        $this->db->delete('tasks')
            ->where('id', '=' , $id)
            ->run();

        return $this->response->redirect('/tasks', 301);
    }
}
