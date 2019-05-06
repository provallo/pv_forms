<?php

namespace ProVallo\Controllers\Backend;

use Favez\ORM\Entity\Entity;
use ProVallo\Plugins\Backend\Components\Controllers\API;
use ProVallo\Plugins\Forms\Models\Form\Form;
use ProVallo\Plugins\Forms\Models\Form\Submission;

class SubmissionController extends API
{
    
    public function configure ()
    {
        return [
            'model' => Submission::class
        ];
    }
    
    protected function getListQuery ()
    {
        $id    = self::request()->getParam('id');
        $query = parent::getListQuery();
        
        return $query->where('formID = ?', $id)->orderBy('id DESC');
    }
    
}