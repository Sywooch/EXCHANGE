<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m161212_043457_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
            'date' => $this->date(),
            'watches' => $this->integer(),
            'enabled' => $this->boolean()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
