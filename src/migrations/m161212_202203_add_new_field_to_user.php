<?php

use yii\db\cubrid\Schema;
use yii\db\Migration;

class m161212_202203_add_new_field_to_user extends Migration
{
	public function up()
	{
		$this->addColumn('{{%user}}', 'source', $this->string(255));
	}

	public function down()
	{
		$this->dropColumn('{{%user}}', 'source');
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
