<?php

namespace ProVallo\Plugins\Forms\Models\Form;

use Favez\Mvc\ORM\Entity;

class Translation extends Entity
{
    public const SOURCE = 'form_translation';
    
    public const SHOULD_UPDATE_WITH_PARENT = true;
    
    public const SHOULD_REMOVE_WITH_PARENT = true;
    
    public $id;
    
    public $formID;
    
    public $languageID;
    
    public $label;
    
    public $successText;
    
    public $submissionTemplate;
    
}