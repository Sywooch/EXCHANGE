<?php

use yii\db\Migration;

/**
 * Handles the creation of table `banner`.
 */
class m161215_144151_create_banner_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('banner', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'code' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('banner');
    }
}
