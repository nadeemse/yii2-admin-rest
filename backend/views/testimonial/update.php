<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Testimonial */

$this->title = 'Update Testimonial: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Testimonials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="row">

    <div class="menu-create card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>
