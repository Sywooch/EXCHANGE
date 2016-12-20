<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonus".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property integer $percent
 */
class Bonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'number'],
            [['percent'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'percent' => 'Percent',
        ];
    }
}
