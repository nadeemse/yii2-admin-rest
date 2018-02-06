<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Blogs */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Blogs',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="blogs-update card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
