<?php

namespace ProVallo\Plugins\Forms\Migrations;

use ProVallo\Components\Database\Migration;

class Migration_4 extends Migration
{
    
    public function up ()
    {
        $this->addSQL('
            ALTER TABLE `form`
              ADD COLUMN `successText` TEXT NOT NULL
              AFTER `data`;
        ');
    }
    
    public function down ()
    {
        // TODO: Implement down() method.
    }
    
}