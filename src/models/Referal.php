<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referal".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $referal_id
 * @property integer $exchanges
 */
class Referal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'referal_id', 'exchanges'], 'integer'],
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
            'referal_id' => 'Referal ID',
            'exchanges' => 'Exchanges',
        ];
    }

    public function getStatistic(){
    	return $this->hasOne(ReferalStatistic::className(), [
					'user_id'=>'user_id'
			]);
		}

		public function getUser(){
    	return $this->hasOne(User::className(), [
					'id'=>'referal_id'
			]);
		}

	public function getReferer(){
		return $this->hasOne(User::className(), [
				'id'=>'user_id'
		]);
	}
}
