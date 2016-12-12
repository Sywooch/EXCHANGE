<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $date
 * @property integer $watches
 * @property integer $enabled
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

	public function behaviors()
	{
		return [
				[
						'class' => \nsept\behaviors\CyrillicSlugBehavior::className()
				],
				'timestamp' => [
						'class' => TimestampBehavior::className(),
						'attributes' => [
								ActiveRecord::EVENT_BEFORE_INSERT => 'date',
						],
						'value' => function() { return date('Y-m-d'); }
						],
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
            [['content', 'date'], 'safe'],
            [['watches', 'enabled'], 'integer'],
            [['title', 'image', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'date' => 'Date',
            'watches' => 'Watches',
            'enabled' => 'Enabled',
        ];
    }
}
