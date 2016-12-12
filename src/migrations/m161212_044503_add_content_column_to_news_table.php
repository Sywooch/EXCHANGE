<?php

use yii\db\Migration;

/**
 * Handles adding content to table `news`.
 */
class m161212_044503_add_content_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'content', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'content');
    }
}
