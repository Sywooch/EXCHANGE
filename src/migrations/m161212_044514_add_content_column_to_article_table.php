<?php

use yii\db\Migration;

/**
 * Handles adding content to table `article`.
 */
class m161212_044514_add_content_column_to_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('article', 'content', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('article', 'content');
    }
}
