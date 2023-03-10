<?php 

namespace hj\phpmvc;
use hj\phpmvc\middlewares\BaseMiddleware;

class Controller {

    public string $layout = 'main';
    protected array $middlewares = [];
    public string $action = '';

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = 'auth';
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}
 