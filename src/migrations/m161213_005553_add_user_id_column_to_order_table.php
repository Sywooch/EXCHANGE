<?php

use yii\db\Migration;

/**
 * Handles adding user_id to table `order`.
 */
class m161213_005553_add_user_id_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'user_id', $this->integer()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order', 'user_id');
    }
}
