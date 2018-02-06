<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Areas');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="areas-index card card-box">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p class="pull-right">
            <?= Html::a(Yii::t('app', 'Create Areas'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                [
                    'attribute' => 'city_id',
                    'value' => function($model) {
                        return $model->city->name;
                    }
                ],
                //'area_code',
                //'description',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        return $model->status == 1 ? 'Active' : 'In-Active';
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
