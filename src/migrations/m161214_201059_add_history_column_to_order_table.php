<?php

use yii\db\Migration;

/**
 * Handles adding history to table `order`.
 */
class m161214_201059_add_history_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'history', $this->boolean()->defaultValue(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order', 'history');
    }
}
