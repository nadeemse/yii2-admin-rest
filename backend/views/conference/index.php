<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conferences';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <div class="card card-box">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p class="pull-right">
            <?= Html::a('Create Conferences', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                'short_description',
                'sort_order',
                // 'description',
                // 'dp_style',
                // 'banner_id',
                // 'created_at',
                // 'updated_at',
                'status',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>

</div>

