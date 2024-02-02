<?php

namespace App\Endpoint\Web;

use Cycle\Database\DatabaseInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class UpdateTaskController implements SingletonInterface
{
    use PrototypeTrait;

    private readonly DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    #[Route(route: '/tasks/<id:\d+>', name: 'task.update', methods: 'PUT')]
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $fields = $request->getParsedBody();
        $id = $request->getAttribute('matches')['id'];

        $this->db->update('tasks')
            ->where('id', '=' , $id)
            ->values([
                'title' => $fields['title']
            ])
            ->run();

        return $this->response->redirect('/tasks/' . $id, 301);
    }
}
