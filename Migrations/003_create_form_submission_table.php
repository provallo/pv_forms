<?php

namespace ProVallo\Plugins\Forms\Migrations;

use ProVallo\Components\Database\Migration;

class Migration_3 extends Migration
{
    
    public function up ()
    {
        $this->addSQL('
            CREATE TABLE `form_submission` (
              `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `formID` INT(11) NOT NULL,
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