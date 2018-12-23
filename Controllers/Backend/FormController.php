<?php

namespace ProVallo\Controllers\Backend;

use Favez\ORM\Entity\Entity;
use ProVallo\Plugins\Backend\Components\Controllers\API;
use ProVallo\Plugins\Forms\Models\Form\Form;

class FormController extends API
{
    
    public function configure ()
    {
        return [
            'model' => Form::class
        ];
    }
    
    protected function setDefaultValues (Entity $entity)
    {
        $entity->created = date('Y-m-d H:i:s');
    }
    
    protected function setValues (Entity $entity, $input)
    {
        $entity->changed = date('Y-m-d H:i:s');
        
        $entity->label = $input['label'];
        $entity->data  = $input['data'];
    }
    
}