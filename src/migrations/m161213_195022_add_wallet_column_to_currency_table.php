<?php

use yii\db\Migration;

/**
 * Handles adding wallet to table `currency`.
 */
class m161213_195022_add_wallet_column_to_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('currency', 'wallet', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('currency', 'wallet');
    }
}
