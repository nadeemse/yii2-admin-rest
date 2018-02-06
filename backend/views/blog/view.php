<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Blogs */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="blogs-view card card-box">


        <p class="pull-right">
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'short_description',
                'description:ntext',
                'banner',
                'banner_id',
                'created_at',
                'updated_at',
                'created_by',
                [
                    'attribute' => 'status',
                    'value' => $model->status === 1 ? 'Active' : 'In-Active'
                ],
                [
                    'attribute' => 'onHome',
                    'value' => $model->onHome === 1 ? 'Yes' : 'No'
                ],
            ],
        ]) ?>

    </div>
</div>
