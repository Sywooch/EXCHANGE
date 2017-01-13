<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credentials".
 *
 * @property integer $id
 * @property string $slug
 * @property string $value
 */
class Credential extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'credentials';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['value'], 'string'],
				[['slug'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'id' => 'ID',
				'slug' => 'Slug',
				'value' => 'Value',
		];
	}
}