<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Languages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Languages',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="languages-create card card-box">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
