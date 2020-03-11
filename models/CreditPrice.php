<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credit_price".
 *
 * @property integer $id
 * @property integer $price
 */
class CreditPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credit_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
        ];
    }
}
