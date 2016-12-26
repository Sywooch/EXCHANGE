<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "exchange_direction".
 *
 * @property integer $id
 * @property integer $currency_from
 * @property integer $currency_to
 * @property string $course
 * @property double $exchange_percent
 * @property integer $min
 * @property integer $max
 * @property integer $min_comission
 * @property integer $enabled
 */
class ExchangeDirection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange_direction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_from', 'currency_to', 'min', 'max', 'min_comission', 'enabled'], 'integer'],
            [['course', 'exchange_percent'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_from' => 'Currency From',
            'currency_to' => 'Currency To',
            'course' => 'Course',
            'exchange_percent' => 'Exchange Percent',
            'min' => 'Min',
            'max' => 'Max',
            'min_comission' => 'Min Comission',
            'enabled' => 'Enabled',
        ];
    }

    public function fields() {
        return ArrayHelper::merge(parent::fields(), [
            'ajaxIcon' => function($model){
        		if($model->to){
							return $model->to->getImage() ? $model->to->getImage()->getUrl() : '';
						}
            },
            'currencyTitle' => function($model){
                return $model->to->title;
            },
            'currencyType' => function($model){
                return $model->to->type;
            },
            'currencyId' => function($model){
                return $model->to->id;
            },
						'currencyReserve' => function($model){
							return $model->to->reserve.' '.$model->to->type;
						},
						'to' => function($model){
							return $model->to;
						},
						'from' => function($model){
							return $model->from;
						},
						'courseCounted' => function($model){
							return round((float)$model->course - ((float)$model->course * (float)$model->exchange_percent / 100), 4);
						}
        ]);
    }

    public function getTo(){
        return $this->hasOne(Currency::className(), ['id'=>'currency_to']);
    }

    public function getFrom(){
        return $this->hasOne(Currency::className(), ['id'=>'currency_from']);
    }
}
