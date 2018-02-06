<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contact Types');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <div class="contact-types-index card-box card">

        <p class="pull-right">
            <?= Html::a(Yii::t('app', 'Create Contact Types'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'status',
                    'value' => function($model) {
                        return $model->status == 1 ? 'Active' : 'In-Active';
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</div>