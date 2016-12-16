<?php

use yii\db\Migration;

/**
 * Handles the creation of table `referal_order`.
 */
class m161216_183750_create_referal_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('referal_order', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'sum' => $this->money(),
            'currency_id' => $this->integer(),
            'date' => $this->datetime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('referal_order');
    }
}
