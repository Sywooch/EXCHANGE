<?php

use yii\db\Migration;

class m161216_194404_add_field_id_to_user_wallet_table extends Migration
{
    public function up()
    {
			$this->addColumn('user_wallet', 'field_id', 'integer');
    }

    public function down()
    {
        echo "m161216_194404_add_field_id_to_user_wallet_table cannot be reverted.\n";

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
