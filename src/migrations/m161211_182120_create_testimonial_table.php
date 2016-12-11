<?php

use yii\db\Migration;

/**
 * Handles the creation of table `testimonial`.
 */
class m161211_182120_create_testimonial_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('testimonial', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'avatar' => $this->string(),
            'email' => $this->string(),
            'content' => $this->text(),
            'enabled' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('testimonial');
    }
}
