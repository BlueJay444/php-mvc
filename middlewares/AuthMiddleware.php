<?php

namespace hj\phpmvc\middlewares;

use hj\phpmvc\Application;
use hj\phpmvc\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware{

    public array $actions = [];

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isGuest()) {
            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}