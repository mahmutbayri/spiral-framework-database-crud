<?php

namespace App\Endpoint\Web;

use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class HomeController implements SingletonInterface
{
    use PrototypeTrait;

    #[Route(route: '/', name: 'index', methods: 'GET')]
    public function index(ServerRequestInterface $request): string
    {
        return $this->views->render('home');
    }
}
