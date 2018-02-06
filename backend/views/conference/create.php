<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Conferences */

$this->title = 'Create Conferences';
$this->params['breadcrumbs'][] = ['label' => 'Conferences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="card card-box">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    </div>

</div>
