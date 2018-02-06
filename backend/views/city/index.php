<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cities');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="card-box card">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>

<div class="row">
    <div class="cities-index card card-box">

        <p class="pull-right">
            <?= Html::a(Yii::t('app', 'Create Cities'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                [
                    'attribute' => 'state_id',
                    'value' => function($model) {
                        return ($model->state !== null ? $model->state->name : '');
                    }
                ],
                [
                    'attribute' => 'country_id',
                    'value' => function($model) {
                        return $model->country->country_name;
                    }
                ],
                'city_code',
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
