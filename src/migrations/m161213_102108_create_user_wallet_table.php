<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_wallet`.
 */
class m161213_102108_create_user_wallet_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_wallet', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer(),
            'user_id' => $this->integer(),
            'wallet' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_wallet');
    }
}
