<?php

namespace App\Endpoint\Web;

use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class CreateTaskController implements SingletonInterface
{
    use PrototypeTrait;

    #[Route(route: '/tasks/create', name: 'task.create', methods: 'GET')]
    public function index(ServerRequestInterface $request): string
    {
        return $this->views->render('tasks/create');
    }
}
