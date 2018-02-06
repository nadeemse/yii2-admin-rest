<?php

namespace api\modules\information\v1\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blogs".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property integer $banner
 * @property integer $banner_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $status
 * @property string $slug
 *
 * @property BlogComments[] $blogComments
 * @property Accounts $createdBy
 */
class Blogs extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blogs';
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
            [['title', 'short_description', 'description', 'created_by'], 'required'],
            [['description', 'slug'], 'string'],
            [['banner_id', 'created_at', 'updated_at', 'created_by', 'status'], 'integer'],
            [['title', 'short_description', 'banner'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'banner' => Yii::t('app', 'Banner'),
            'banner_id' => Yii::t('app', 'Banner ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
