<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactUsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contact uses');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="card-box card">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>

<div class="row">
    <div class="contact-us-index card-box card">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'first_name',
                'last_name',
                'phone_number',
                'email:email',
                [
                    'attribute' => 'type_id',
                    'value' => function($model) {
                        return $model->type->name;
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => ' {view} {delete}',
                ],
            ],
        ]); ?>
    </div>
</div>

