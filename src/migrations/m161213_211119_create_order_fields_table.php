<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_fields`.
 */
class m161213_211119_create_order_fields_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_fields', [
            'id' => $this->primaryKey(),
            'field_id' => $this->integer(),
            'value' => $this->string(),
            'order_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_fields');
    }
}
