<?php

namespace hj\phpmvc\form;
use hj\phpmvc\Model;
use hj\phpmvc\form\Field;

class Form{

    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();

    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

}