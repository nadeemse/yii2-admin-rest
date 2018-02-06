<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestimonialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testimonials';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">

    <div class="card card-box">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p class="pull-right">
            <?= Html::a('Create Testimonial', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'customer',
                'designation',
                'rating',

                // 'created_at',
                // 'updated_at',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        return $model->status ? 'Active' : 'In-Active';
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    </div>

</div>
