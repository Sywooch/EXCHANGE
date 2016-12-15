<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $image
 * @property string $code
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
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
            [['image', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'code' => 'Code',
        ];
    }
}
