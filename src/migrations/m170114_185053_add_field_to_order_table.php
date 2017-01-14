<?php

use yii\db\Migration;

class m170114_185053_add_field_to_order_table extends Migration
{
    public function up()
    {

    	$this->addColumn('order', 'phone', $this->string()->defaultValue(''));

    	return true;

    }

    public function down()
    {

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
