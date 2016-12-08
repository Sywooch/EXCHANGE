<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $title
 * @property string $icon
 * @property string $reserve
 * @property string $type
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reserve'], 'number'],
            [['title', 'type'], 'string', 'max' => 255],
            [['icon'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'icon' => 'Иконка',
            'reserve' => 'Резерв',
            'type' => 'Тип',
        ];
    }

    public function getDirections() {
        return $this->hasMany(ExchangeDirection::className(), ['currency_from'=>'id']);
    }

}
