<?php

use yii\db\Migration;

/**
 * Handles adding date to table `testimonial`.
 */
class m161211_190904_add_date_column_to_testimonial_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('testimonial', 'date', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('testimonial', 'date');
    }
}
