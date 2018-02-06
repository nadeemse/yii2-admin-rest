<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="card card-box">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="news-index card card-box">
        <p class="pull-right">
            <?= Html::a(Yii::t('app', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',

                'tag',
                // 'banner_id',
                'viewCount',
                'commentCount',
                'likeCount',
                // 'created_at',
                // 'updated_at',
                'created_by',
                'status',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?></div>

</div>
