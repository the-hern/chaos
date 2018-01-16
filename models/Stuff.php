<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stuff".
 *
 * @property int $id
 * @property string $name
 * @property int $bin_id
 *
 * @property Bin $bin
 */
class Stuff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stuff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['bin_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['bin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bin::className(), 'targetAttribute' => ['bin_id' => 'id']],
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
            'bin_id' => 'Bin ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBin()
    {
        return $this->hasOne(Bin::className(), ['id' => 'bin_id']);
    }
}
