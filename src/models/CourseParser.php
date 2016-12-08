<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course_parser".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $value
 * @property string $updated
 */
class CourseParser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course_parser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'number'],
            [['updated'], 'safe'],
            [['from', 'to'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'value' => 'Value',
            'updated' => 'Updated',
        ];
    }
}
