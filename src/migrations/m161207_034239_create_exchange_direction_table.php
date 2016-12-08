<?php

use yii\db\Migration;

/**
 * Handles the creation of table `exchange_direction`.
 */
class m161207_034239_create_exchange_direction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('exchange_direction', [
            'id' => $this->primaryKey(),
            'currency_from' => $this->integer(),
            'currency_to' => $this->integer(),
            'course' => $this->money(),
            'exchange_percent' => $this->float(),
            'min' => $this->integer(),
            'max' => $this->integer(),
            'min_comission' => $this->integer(),
            'enabled' => $this->boolean()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('exchange_direction');
    }
}
