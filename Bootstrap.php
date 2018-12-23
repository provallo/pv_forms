<?php

namespace ProVallo\Plugins\Forms;

use ProVallo\Core;

class Bootstrap extends \ProVallo\Components\Plugin\Bootstrap
{
    
    public function install ()
    {
        $this->installDB();
        
        return true;
    }
    
    public function execute()
    {
        // Register custom controllers
        $this->registerController('Backend', 'Form');
    
        // Register backend extensions
        Core::events()->subscribe('backend.register', function () {
            return [
                $this
            ];
        });
    }

}