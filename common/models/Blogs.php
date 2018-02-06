<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

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
 * @property integer $onHome
 * @property string $slug
 *
 * @property BlogComments[] $blogComments
 * @property Accounts $createdBy
 */
class Blogs extends \yii\db\ActiveRecord
{
    /**
     * @var
     */
    public $profile;

    /**
     * @var
     */
    public $nextPost;

    /**
     * @var
     */
    public $previousPost;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * Fields
     * */
    public function fields() {
        $fields = parent::fields();
        $fields[] = 'profile';
        $fields[] = 'nextPost';
        $fields[] = 'previousPost';
        return $fields;
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
            [['banner_id', 'created_at', 'updated_at', 'created_by', 'status', 'onHome'], 'integer'],
            [['title', 'short_description', 'banner'], 'string', 'max' => 255],
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
            'banner_id' => Yii::t('app', 'Banner ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(BlogComments::className(), ['blog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'created_by']);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->slug = str_replace(' ', '-', $this->title);

            return true;
        } else {
            return false;
        }
    }


    public function afterFind() {

        parent::afterFind();

        $this->profile = [
            'name' => $this->createdBy->first_name,
            'email' => $this->createdBy->email,
            'about_me' => $this->createdBy->about_me,
            'picture' => $this->createdBy->picture
        ];

        $sql = 'SELECT title, slug from blogs where id < '.$this->id;
        $previous = Yii::$app->db->createCommand($sql)->queryOne();


        $sql = 'SELECT title, slug from blogs where id > '.$this->id;
        $next = Yii::$app->db->createCommand($sql)->queryOne();


        if( !empty($next) ) {
            $this->nextPost = [
                'title'     => $next['title'],
                'slug'      => $next['slug'],
            ];
        } else {
            $this->nextPost = [];
        }

        if( !empty($previous) ) {
            $this->previousPost = [
                'title'     => $previous['title'],
                'slug'      => $previous['slug'],
            ];
        } else {
            $this->previousPost = [];
        }

    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'onHome' => $this->onHome,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
