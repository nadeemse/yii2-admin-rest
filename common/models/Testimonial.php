<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "testimonial".
 *
 * @property integer $id
 * @property string $customer
 * @property string $designation
 * @property string $logo
 * @property integer $rating
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
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

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer', 'designation'], 'required'],
            [['rating', 'created_at', 'updated_at', 'status'], 'integer'],
            [['customer', 'designation', 'logo'], 'string', 'max' => 255],
            [['review'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer' => 'Customer',
            'designation' => 'Designation',
            'logo' => 'Logo',
            'review' => 'Review',
            'rating' => 'Rating',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
