<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="blogs-index card card-box">

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <p class="pull-right">
            <?= Html::a(Yii::t('app', 'Create Blogs'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                //'short_description',
                //'description:ntext',
                //'banner',
                // 'banner_id',
               // 'created_at',
                // 'updated_at',
                //'created_by',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                       return $model->status === 1 ? 'Active' : 'In-Active';
                    }
                ],
                [
                    'attribute' => 'onHome',
                    'value' => function($model) {
                        return $model->onHome === 1 ? 'Yes' : 'No';
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>

</div>
