<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $name
 * @property string $designation
 * @property string $pic
 * @property string $bio
 * @property string $address
 * @property string $phone_number
 * @property string $email
 * @property string $short_bio
 * @property string $facebook
 * @property string $linkedin
 * @property string $twitter
 * @property string $youtube
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $sort_order
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'designation'], 'required'],
            [['created_at', 'updated_at', 'status', 'sort_order'], 'integer'],
            [['bio'], 'safe'],
            [['name', 'designation', 'pic', 'facebook', 'linkedin', 'twitter', 'youtube', 'short_bio'], 'string', 'max' => 255],
            [['address', 'phone_number', 'email'], 'string', 'max' => 255],
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
            'designation' => 'Designation',
            'pic' => 'Pic',
            'bio' => 'Bio',
            'short_bio' => 'Short Bio',
            'facebook' => 'Facebook',
            'linkedin' => 'Linkedin',
            'twitter' => 'Twitter',
            'youtube' => 'Youtube',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
