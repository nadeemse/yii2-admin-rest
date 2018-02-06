<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContactUs */

$this->title = Yii::t('app', 'Create Contact Us');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact uses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-us-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
