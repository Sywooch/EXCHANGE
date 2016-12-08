<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m161207_014851_create_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'icon' => $this->string(),
            'reserve' => $this->money(15,2),
            'type' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('currency');
    }
}
