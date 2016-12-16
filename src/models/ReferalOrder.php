<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referal_order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $sum
 * @property integer $currency_id
 * @property string $date
 */
class ReferalOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referal_order';
    }

		const STATUS_IN_WORK = 2;
		const STATUS_INACTIVE = 0;
		const STATUS_ACCEPTED = 4;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'currency_id', 'status'], 'integer'],
            [['sum'], 'number'],
            [['date', 'wallet'], 'safe'],
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
            'sum' => 'Sum',
            'currency_id' => 'Currency ID',
            'date' => 'Date',
        ];
    }

    public function getCurrency(){
    	return $this->hasOne(Currency::className(), [
    		'id'=>'currency_id'
			]);
		}

	public function getUser(){
		return $this->hasOne(User::className(), [
				'id'=>'user_id'
		]);
	}
}
