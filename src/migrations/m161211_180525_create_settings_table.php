<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class m161211_180525_create_settings_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('settings', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'content' => $this->text(),
            'type' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('settings');
    }
}
