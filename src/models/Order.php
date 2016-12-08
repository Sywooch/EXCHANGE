<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $exchange_id
 * @property string $from_value
 * @property string $to_value
 * @property string $card
 * @property string $bank
 * @property string $fio
 * @property string $wallet
 * @property string $email
 * @property string $date
 * @property integer $status
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchange_id', 'status'], 'integer'],
            [['from_value', 'to_value'], 'number'],
            [['date'], 'safe'],
            [['card', 'bank', 'fio', 'wallet', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exchange_id' => 'Exchange ID',
            'from_value' => 'From Value',
            'to_value' => 'To Value',
            'card' => 'Card',
            'bank' => 'Bank',
            'fio' => 'Fio',
            'wallet' => 'Wallet',
            'email' => 'Email',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }

    public function getExchange() {
        return $this->hasOne(ExchangeDirection::className(), [
            'id'=>'exchange_id'
        ]);
    }
}
