<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

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

    const STATUS_IN_WORK = 2;
    const STATUS_INACTIVE = 0;
    const STATUS_PAYED_USER = 3;
    const STATUS_ACCEPTED = 4;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exchange_id', 'status', 'user_id', 'history'], 'integer'],
            [['from_value', 'to_value'], 'number'],
            [['date'], 'safe'],
            [['card', 'bank', 'fio', 'wallet', 'email', 'ip','voucher', 'phone'], 'string', 'max' => 255],
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

    public function getLocation($attribute = 'name'){
        $geo = new \jisoft\sypexgeo\Sypexgeo();

        $location = $geo->get($this->ip);

        $out['name'] = $location['country']['name_ru'];
        $out['img'] = Html::img('/img/country/'.strtolower($location['country']['iso']).'.png');
		$out['imgUrl'] = '/img/country/'.strtolower($location['country']['iso']).'.png';

        return $out[$attribute];
    }

    public function getFields() {
    	return $this->hasMany(OrderFields::className(),[
    			'order_id'=>'id'
			]);
		}

		public function getUser(){
    	return $this->hasOne(User::className(), [
    			'id'=>'user_id'
			]);
		}

}
