<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m161212_043622_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
            'date' => $this->date(),
            'watches' => $this->integer(),
            'enabled' => $this->boolean()->defaultValue(1),
            'is_main' => $this->boolean()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
