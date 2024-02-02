<?php

namespace App\Endpoint\Web;

use Cycle\Database\DatabaseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class StoreTaskController implements SingletonInterface
{
    use PrototypeTrait;

    private readonly DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    #[Route(route: '/tasks', name: 'task.store', methods: 'POST')]
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $fields = $request->getParsedBody();

        $insertId = $this->db->insert('tasks')
            ->values([
                'title' => $fields['title']
            ])
            ->run();

        return $this->response->redirect('/tasks/' . $insertId, 301);
    }
}
