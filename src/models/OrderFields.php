<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_fields".
 *
 * @property integer $id
 * @property integer $field_id
 * @property string $value
 * @property integer $order_id
 */
class OrderFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field_id', 'order_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'field_id' => 'Field ID',
            'value' => 'Value',
            'order_id' => 'Order ID',
        ];
    }

    public function getField(){
    	return $this->hasOne(CurrencyFields::className(),[
    			'id'=>'field_id'
			]);
		}
}
