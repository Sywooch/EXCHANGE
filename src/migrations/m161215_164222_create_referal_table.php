<?php

use yii\db\Migration;

/**
 * Handles the creation of table `referal`.
 */
class m161215_164222_create_referal_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('referal', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'referal_id' => $this->integer(),
            'exchanges' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('referal');
    }
}
