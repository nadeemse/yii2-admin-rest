<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Partners */

$this->title = 'Create Partners';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
