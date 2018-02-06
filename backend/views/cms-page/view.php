<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CmsPages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cms Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="cms-pages-view card card-box">

        <p class="pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'seo_url:url',
                'description:ntext',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'seo_keywords',
                [
                    'attribute' => 'bottom',
                    'value' => $model->bottom == 1 ? 'Yes' : 'No',

                ],
                [
                    'attribute' => 'top',
                    'value' => $model->top == 1 ? 'Yes' : 'No',

                ],
                'sort_order',
                'banner_image',
                [
                    'attribute' => 'status',
                    'value' => $model->status == 1 ? 'Active' : 'In-Active',
                ],
            ],
        ]) ?>

    </div>
</div>
