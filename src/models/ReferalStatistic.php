<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referal_statistic".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $incoming
 */
class ReferalStatistic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referal_statistic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'incoming'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'incoming' => 'Incoming',
        ];
    }
}
