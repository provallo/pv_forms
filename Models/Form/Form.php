<?php

namespace ProVallo\Plugins\Forms\Models\Form;

use Favez\Mvc\ORM\Entity;

class Form extends Entity
{
    
    const SOURCE = 'form';
    
    public $id;
    
    public $label;
    
    public $data;
    
    public $created;
    
    public $changed;
    
    public function validate ()
    {
        return [
            'label' => [
                'required' => 'Please enter a label'
            ],
            'data'  => [
                'required' => 'The form configuration can not be empty'
            ]
        ];
    }
    
}