<?php

use yii\db\Migration;

class m161220_023629_add_columns_to_currency extends Migration
{
    public function up()
    {
			$this->addColumn('currency', 'is_voucher', $this->boolean());
			$this->addColumn('currency', 'voucher_title', $this->string()->defaultValue('Код ваучера'));
    }

    public function down()
    {
        echo "m161220_023629_add_columns_to_currency cannot be reverted.\n";

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
