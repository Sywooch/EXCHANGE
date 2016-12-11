<?php

use yii\db\Migration;

/**
 * Handles adding ip to table `order`.
 */
class m161211_173042_add_ip_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'ip', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order', 'ip');
    }
}
