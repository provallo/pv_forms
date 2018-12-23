<?php

namespace ProVallo\Plugins\Forms\Migrations;

use ProVallo\Components\Database\Migration;

class Migration_1 extends Migration
{
    
    public function up ()
    {
        $this->addSQL('
            CREATE TABLE `form` (
              `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `label` VARCHAR(255) NOT NULL,
              `data` BLOB NOT NULL,
              `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `changed` DATETIME
            );
        ');
    }
    
    public function down ()
    {
        // TODO: Implement down() method.
    }
    
}