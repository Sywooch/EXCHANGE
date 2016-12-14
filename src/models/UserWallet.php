<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_wallet".
 *
 * @property integer $id
 * @property integer $currency_id
 * @property integer $user_id
 * @property string $wallet
 */
class UserWallet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_wallet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_id', 'user_id'], 'integer'],
            [['wallet'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'wallet' => 'Wallet',
        ];
    }

    public function getCurrency(){
    	return $this->hasOne(Currency::className(), [
    			'currency_id'=>'id'
			]);
		}

}
