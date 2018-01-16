<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bin".
 *
 * @property int $id
 * @property int $number
 * @property string $description
 *
 * @property Stuff[] $stuffs
 */
class Bin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number'], 'required'],
            [['number'], 'integer'],
            [['description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStuffs()
    {
        return $this->hasMany(Stuff::className(), ['bin_id' => 'id']);
    }
}
