<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "testimonial".
 *
 * @property integer $id
 * @property string $name
 * @property string $avatar
 * @property string $email
 * @property string $content
 * @property integer $enabled
 */
class Testimonial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testimonial';
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
            [['content'], 'string'],
            [['enabled'], 'integer'],
            [['name', 'avatar', 'email'], 'string', 'max' => 255],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'avatar' => 'Avatar',
            'email' => 'Email',
            'content' => 'Content',
            'enabled' => 'Enabled',
        ];
    }
}
