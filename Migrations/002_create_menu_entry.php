<?php

namespace ProVallo\Plugins\Forms\Migrations;

use ProVallo\Components\Database\Migration;

class Migration_2 extends Migration
{
    
    public function up ()
    {
        $this->addSQL('
            INSERT INTO `menu` (parentID, label, route, position) VALUES
              (-1, "Forms", "/forms", 3);
        ');
    }
    
    public function down ()
    {
        // TODO: Implement down() method.
    }
    
}