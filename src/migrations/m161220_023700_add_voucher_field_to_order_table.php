<?php

use yii\db\Migration;

class m161220_023700_add_voucher_field_to_order_table extends Migration
{
    public function up()
    {
				$this->addColumn('order', 'voucher', $this->string());
    }

    public function down()
    {
        echo "m161220_023700_add_voucher_field_to_order_table cannot be reverted.\n";

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
