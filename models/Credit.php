<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credit".
 *
 * @property integer $id
 * @property integer $notaris_id
 * @property integer $buy
 * @property integer $used
 * @property string $price
 *
 * @property Notaris $notaris
 */
class Credit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notaris_id'], 'required'],
            [['notaris_id', 'buy', 'used'], 'integer'],
            [['price'], 'string', 'max' => 45],
            [['notaris_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notaris::className(), 'targetAttribute' => ['notaris_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notaris_id' => 'Notaris ID',
            'buy' => 'Buy',
            'used' => 'Used',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotaris()
    {
        return $this->hasOne(Notaris::className(), ['id' => 'notaris_id']);
    }
}
