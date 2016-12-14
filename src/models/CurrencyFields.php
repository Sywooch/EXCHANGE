<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency_fields".
 *
 * @property integer $id
 * @property integer $currency_id
 * @property string $title
 */
class CurrencyFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_id' => 'Currency ID',
            'title' => 'Title',
        ];
    }
}
