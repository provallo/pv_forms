<?php

namespace ProVallo\Plugins\Forms\Models\Form;

use Favez\Mvc\ORM\Entity;

class Form extends Entity
{
    
    const SOURCE = 'form';
    
    public $id;
    
    public $label;
    
    public $data;
    
    public $successText;
    
    public $submissionTemplate;
    
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
            ],
            'successText' => [
                'required' => 'Please enter a success text'
            ],
            'submissionTemplate' => [
                'required' => 'Please enter a submission template'
            ]
        ];
    }
    
}