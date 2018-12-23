<?php

namespace ProVallo\Plugins\Forms\Models\Form;

use Favez\Mvc\ORM\Entity;

class Submission extends Entity
{
    
    const SOURCE = 'form_submission';
    
    public $id;
    
    public $formID;
    
    public $data;
    
    public $created;
    
    public $changed;
    
}