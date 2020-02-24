<?php

namespace ProVallo\Plugins\Forms\Migrations;

use ProVallo\Components\Database\Migration;

class Migration_5 extends Migration
{
    
    public function up ()
    {
        $this->addSQL('
            CREATE TABLE `form_translation` (
              `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `formID` INT(11) NOT NULL,
              `languageID` INT(11) NOT NULL,
              `label` VARCHAR(255) NOT NULL,
              `successText` TEXT NOT NULL,
              `submissionTemplate` TEXT NOT NULL
            );
        ');
    }
    
    public function down ()
    {
        // TODO: Implement down() method.
    }
    
}