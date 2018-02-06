<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\States */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'States',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'States'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="row">
    <div class="card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
