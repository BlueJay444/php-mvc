<?php

namespace hj\phpmvc\form;

class TextAreaField extends BaseFIeld{
    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',   
        $this->attribute, // name
        $this->model->hasError($this->attribute) ? ' is-invalid' : '', // class 
        $this->model->{$this->attribute}, // value       
    );
    }
}