<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "package_features".
 *
 * @property integer $id
 * @property integer $package_id
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property integer $sort_order
 *
 * @property Packages $package
 */
class PackageFeatures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'package_features';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_id', 'title', 'description'], 'required'],
            [['package_id', 'status', 'sort_order'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'package_id' => Yii::t('app', 'Package ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'sort_order' => Yii::t('app', 'Sort order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Packages::className(), ['id' => 'package_id']);
    }
}
