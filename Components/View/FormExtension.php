<?php

namespace ProVallo\Plugins\Forms\Components\View;

use ProVallo\Core;
use ProVallo\Plugins\Forms\Models\Form\Form;
use ProVallo\Plugins\Frontend\Bootstrap;

class FormExtension extends \Twig_Extension
{
    
    public function getName ()
    {
        return 'Form ViewExtension';
    }
    
    public function getFunctions ()
    {
        $functions = [
            'form',
            'markdown'
        ];
        $result    = [];
        
        foreach ($functions as $functionName)
        {
            $result[] = new \Twig_SimpleFunction($functionName, [
                $this,
                $functionName . 'Function'
            ]);
        }
        
        return $result;
    }
    
    public function markdownFunction ($data)
    {
        $config = Bootstrap::getConfig();
        $parser = new \Parsedown();
        $parser->setSafeMode($config['parsedown.safe_mode']);
        
        return $parser->parse($data);
    }
    
    public function formFunction ($formID)
    {
        Core::view()->loader()->addPath(path(__DIR__ . '/../../', 'Views'));
        
        $form    = Form::repository()->find($formID);
        $context = [];
        
        if ($form instanceof Form)
        {
            $form->data = json_decode($form->data, true);
            $config     = \ProVallo\Plugins\Forms\Bootstrap::getConfig();
            
            $languages  = Core::di()->get('frontend.translation')->getLanguages();
            $languageID = null;
            
            foreach ($languages as $language)
            {
                if ($language['selected'])
                {
                    $languageID = (int) $language['id'];
                    break;
                }
            }
            
            if ($languageID > 0)
            {
                foreach ($form->data['items'] as $i => $item)
                {
                    if (!isset($item['translations']))
                    {
                        continue;
                    }
                    
                    foreach ($item['translations'] as $translation)
                    {
                        if ($translation['languageID'] !== $languageID)
                        {
                            continue;
                        }
                        
                        foreach ($translation as $key => $value)
                        {
                            if ($key === 'languageID')
                            {
                                continue;
                            }
                            
                            if (isset($value))
                            {
                                $item['config'][$key] = $value;
                            }
                        }
                    }
                    
                    $form->data['items'][$i] = $item;
                }
            }
            
            $context['form']      = $form;
            $context['recaptcha'] = [
                'enabled'  => $config['recaptcha.enabled'] ?? false,
                'site_key' => $config['recaptcha.site_key'] ?? ''
            ];
        }
        
        return Core::view()->render('frontend/form/index', $context);
    }
    
}