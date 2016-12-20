<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bonus`.
 */
class m161220_182609_create_bonus_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('bonus', [
            'id' => $this->primaryKey(),
            'from' => $this->money(),
            'to' => $this->money(),
            'percent' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('bonus');
    }
}
