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
    
    public function initialize ()
    {
        $this->hasMany(Translation::class, 'formID', 'id')->setName('translations');
    }
    
    public function validate ()
    {
        return [
            'data' => [
                'required' => 'The form configuration can not be empty'
            ],
        ];
    }
    
}