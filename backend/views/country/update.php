<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Country',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="country-update card card-box">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
