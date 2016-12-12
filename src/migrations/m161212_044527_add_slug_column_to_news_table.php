<?php

use yii\db\Migration;

/**
 * Handles adding slug to table `news`.
 */
class m161212_044527_add_slug_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'slug', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'slug');
    }
}
