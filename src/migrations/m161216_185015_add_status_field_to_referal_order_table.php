<?php

use yii\db\Migration;

class m161216_185015_add_status_field_to_referal_order_table extends Migration
{
    public function up()
    {
			$this->addColumn('referal_order', 'wallet', 'string');
			$this->addColumn('referal_order', 'status', 'integer');
    }

    public function down()
    {
        echo "m161216_185015_add_status_field_to_referal_order_table cannot be reverted.\n";

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
