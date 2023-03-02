<?php

namespace app\core\form;


class Field extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';
    public string $type;
   
    public function __construct(\app\core\Model $model, $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordField() 
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    public function emailField() 
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control%s">', 
        $this->type,
        $this->attribute, // name
        $this->model->{$this->attribute}, // value
        $this->model->hasError($this->attribute) ? ' is-invalid' : '' // class 
    );
    }
    
}