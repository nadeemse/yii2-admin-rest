<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_comments".
 *
 * @property integer $id
 * @property integer $blog_id
 * @property integer $created_by
 * @property integer $parent_id
 * @property string $comment
 *
 * @property Accounts $createdBy
 * @property Blogs $blog
 */
class BlogComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_id', 'created_by', 'parent_id', 'comment'], 'required'],
            [['blog_id', 'created_by', 'parent_id'], 'integer'],
            [['comment'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Accounts::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blogs::className(), 'targetAttribute' => ['blog_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'blog_id' => Yii::t('app', 'Blog ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blogs::className(), ['id' => 'blog_id']);
    }
}
