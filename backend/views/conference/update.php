<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Conferences */

$this->title = 'Update Conferences: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Conferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="row">

    <div class="card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>