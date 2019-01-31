<?php

namespace ProVallo\Plugins\Forms\Components\View;

use ProVallo\Core;
use ProVallo\Plugins\Forms\Models\Form\Form;
use ProVallo\Plugins\Frontend\Bootstrap;

class FormExtension extends \Twig_Extension
{
    
    public function getName()
    {
        return 'Form ViewExtension';
    }
    
    public function getFunctions()
    {
        $functions = ['form', 'markdown'];
        $result    = [];
        
        foreach($functions as $functionName)
        {
            $result[] = new \Twig_SimpleFunction($functionName, [$this, $functionName . 'Function']);
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
            
            $context['form'] = $form;
            $context['recaptcha'] = [
                'site_key' => $config['recaptcha.site_key']
            ];
        }
        
        return Core::view()->render('frontend/form/index', $context);
    }
    
}