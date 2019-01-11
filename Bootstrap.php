<?php

namespace ProVallo\Plugins\Forms;

use Favez\Mvc\Event\Arguments;
use ProVallo\Core;
use ProVallo\Plugins\Forms\Components\View\FormExtension;

class Bootstrap extends \ProVallo\Components\Plugin\Bootstrap
{
    
    public function install ()
    {
        $this->installDB();
        
        return true;
    }
    
    public function update ($previousVersion)
    {
        $this->installDB();
        
        return true;
    }
    
    public function execute()
    {
        if (Core::instance()->getApi() === Core::API_WEB)
        {
            // Register custom controllers
            $this->registerController('Backend', 'Form');
            $this->registerController('Frontend', 'Form');
    
            // Register view extensions
            Core::events()->subscribe('core.view.init', function (Arguments $args) {
                /** @var \Favez\Mvc\View\View $view */
                $view = $args->get(0);
                $view->engine()->addExtension(new FormExtension());
            });
        }
        
        if (Core::instance()->getApi() === Core::API_CONSOLE)
        {
            // Register backend extensions
            Core::events()->subscribe('backend.register', function () {
                return [
                    $this
                ];
            });
    
            // Register frontend resources
            Core::events()->subscribe('frontend.register.less', function () {
                return [
                    path($this->getPath(), 'Views/_resources/less/all.less')
                ];
            });
    
            Core::events()->subscribe('frontend.register.javascript', function () {
                return [
                    path($this->getPath(), 'Views/_resources/js/jquery.min.js'),
                    path($this->getPath(), 'Views/_resources/js/jquery.form.js')
                ];
            });
        }
    }

}