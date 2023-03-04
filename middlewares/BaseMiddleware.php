<?php

namespace hj\phpmvc\middlewares;

abstract class BaseMiddleware {
    abstract public function execute();
}