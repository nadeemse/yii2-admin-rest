<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "entertainment".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $banner
 * @property string $banner_image
 * @property string $tag
 * @property string $slug
 * @property string $video_url
 * @property integer $banner_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $status
 * @property integer $type
 * @property integer $genres_id
 * @property integer $viewCount
 * @property integer $release_date
 * @property integer $country_id
 *
 * @property Accounts $createdBy
 */
class Entertainment extends \yii\db\ActiveRecord
{
    /**
     * Images Array for this Model
     * */
    public $images = [];
    public $videos = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entertainment';
    }

    /**
     * Extra fields
     * */
    public function extraFields()
    {
        return [
            'entertainmentVideos',
            'entertainmentGallery',
        ];
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
            [['description', 'type', 'banner_image'], 'string'],
            [['images', 'videos', 'type', 'banner_image', 'release_date'], 'safe'],
            [['banner_id', 'created_at', 'updated_at', 'created_by', 'status', 'genres_id', 'viewCount', 'country_id'], 'integer'],
            [['title', 'short_description', 'tag', 'banner', 'slug', 'video_url'], 'string', 'max' => 255],
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
            'banner' => Yii::t('app', 'Banner'),
            'tag' => Yii::t('app', 'Tag'),
            'slug' => Yii::t('app', 'Slug'),
            'banner_id' => Yii::t('app', 'Banner ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->slug = str_replace(' ', '_', $this->title);

            if( ($this->type == 'serial' || $this->type == 'video') && !count($this->videos) ) {
                $this->addError('video', 'you have to upload at least one video');
                return false;
            } else if($this->type == 'gallery' && !$this->banner) {
                $this->addError('image', 'You must have to upload listing image');
                return false;
            }
        }

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'created_by']);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {

        EntertainmentGallery::deleteAll(['entertainment_id' => $this->id]);
        // Save ALL banners Images

        foreach($this->images as $image) {

            $bannerImage = new EntertainmentGallery();
            $bannerImage->attributes = $image;
            $bannerImage->entertainment_id = $this->id;
            $bannerImage->save();
        }


        EntertainmentVideos::deleteAll(['entertainment_id' => $this->id]);
        // Save ALL banners Images

        foreach($this->videos as $image) {

            $bannerImage = new EntertainmentVideos();
            $bannerImage->attributes = $image;
            $bannerImage->entertainment_id = $this->id;
            $bannerImage->save();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntertainmentGallery()
    {
        return $this->hasMany(EntertainmentGallery::className(), ['entertainment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntertainmentVideos()
    {
        return $this->hasMany(EntertainmentVideos::className(), ['entertainment_id' => 'id']);
    }
}
