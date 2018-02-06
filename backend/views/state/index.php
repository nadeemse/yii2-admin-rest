<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'States');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="card card-box">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>

<div class="row">
    <div class="entertainment-index card card-box">

        <p class="pull-right">
            <?= Html::a(Yii::t('app', 'Create States'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'country_id',
                    'value' => function($model) {
                        return $model->country->country_name;
                    },
                ],
                'icon',
                'sort_order',
                // 'status',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>
</div>