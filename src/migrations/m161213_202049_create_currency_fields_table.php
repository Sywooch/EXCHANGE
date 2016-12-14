<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency_fields`.
 */
class m161213_202049_create_currency_fields_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('currency_fields', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer(),
            'title' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('currency_fields');
    }
}
