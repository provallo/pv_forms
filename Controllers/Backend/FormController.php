<?php

namespace ProVallo\Controllers\Backend;

use Favez\ORM\Entity\Entity;
use ProVallo\Plugins\Backend\Components\Controllers\API;
use ProVallo\Plugins\Forms\Models\Form\Form;
use ProVallo\Plugins\Forms\Models\Form\Translation;
use ProVallo\Plugins\Frontend\Models\Language\Language;

class FormController extends API
{
    
    public function configure ()
    {
        return [
            'model'  => Form::class,
            'detail' => [
                'recursive' => true
            ]
        ];
    }
    
    protected function map ($row): array
    {
        $row['translations'] = [];
        
        $form = Form::repository()->find($row['id']);
        
        if ($form instanceof Form)
        {
            // Load available translations
            $row['translations'] = $form->translations->toArray();
            
            $languages = Language::repository()->findAll();
            
            foreach ($languages as $language)
            {
                foreach ($row['translations'] as $translation)
                {
                    if ($translation['languageID'] === $language->id)
                    {
                        continue 2;
                    }
                }
                
                $translation                     = Translation::create();
                $translation->formID             = $row['id'];
                $translation->languageID         = $language->id;
                $translation->label              = $row['label'];
                $translation->successText        = $row['successText'];
                $translation->submissionTemplate = $row['submissionTemplate'];
                
                $row['translations'][] = $translation->toArray();
            }
            
            foreach ($row['translations'] as &$translation)
            {
                $translation['id']         = (int) $translation['id'];
                $translation['formID']     = (int) $translation['formID'];
                $translation['languageID'] = (int) $translation['languageID'];
            }
        }
        
        return parent::map($row);
    }
    
    protected function setDefaultValues (Entity $entity)
    {
        $entity->created = date('Y-m-d H:i:s');
    }
    
    protected function setValues (Entity $entity, $input)
    {
        $entity->changed = date('Y-m-d H:i:s');
        
        $entity->label              = $input['label'];
        $entity->data               = $input['data'];
        $entity->successText        = $input['successText'];
        $entity->submissionTemplate = $input['submissionTemplate'];
        $entity->translations       = $input['translations'];
    }
    
}