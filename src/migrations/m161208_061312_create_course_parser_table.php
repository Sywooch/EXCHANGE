<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course_parser`.
 */
class m161208_061312_create_course_parser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('course_parser', [
            'id' => $this->primaryKey(),
            'from' => $this->string(),
            'to' => $this->string(),
            'value' => $this->money(),
            'updated' => $this->date(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('course_parser');
    }
}
