<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m161208_133012_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'exchange_id' => $this->integer(),
            'from_value' => $this->money(),
            'to_value' => $this->money(),
            'card' => $this->string(),
            'bank' => $this->string(),
            'fio' => $this->string(),
            'wallet' => $this->string(),
            'email' => $this->string(),
            'date' => $this->dateTime(),
            'status' => $this->integer()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
