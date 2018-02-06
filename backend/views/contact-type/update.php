<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContactTypes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Contact Types',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="contact-types-update card-box card">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
