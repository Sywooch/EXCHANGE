<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class m170113_084530_create_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('credentials', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'value' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('credentials');
    }
}
