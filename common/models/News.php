<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property integer $banner
 * @property integer $banner_id
 * @property integer $viewCount
 * @property integer $commentCount
 * @property integer $likeCount
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $status
 * @property string $column
 * @property string $slug
 * @property string $tag
 *
 * @property Accounts $createdBy
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
            [['description', 'column', 'banner', 'slug', 'tag'], 'string'],
            [['banner_id', 'viewCount', 'commentCount', 'likeCount', 'created_at', 'updated_at', 'created_by', 'status'], 'integer'],
            [['title', 'short_description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Accounts::className(), 'targetAttribute' => ['created_by' => 'id']],
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
            'column' => Yii::t('app', 'Style Option'),
            'banner' => Yii::t('app', 'Banner'),
            'banner_id' => Yii::t('app', 'Banner ID'),
            'viewCount' => Yii::t('app', 'View Count'),
            'commentCount' => Yii::t('app', 'Comment Count'),
            'likeCount' => Yii::t('app', 'Like Count'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
            'slug' => Yii::t('app', 'Slug'),
            'tag' => Yii::t('app', 'Tag'),
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->slug = str_replace(' ', '_', $this->title);

            return true;
        }
        return false;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'created_by']);
    }
}
