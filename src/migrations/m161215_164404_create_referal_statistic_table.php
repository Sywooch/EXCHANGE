<?php

use yii\db\Migration;

/**
 * Handles the creation of table `referal_statistic`.
 */
class m161215_164404_create_referal_statistic_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('referal_statistic', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'incoming' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('referal_statistic');
    }
}
