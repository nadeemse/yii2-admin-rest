<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContactTypes */

$this->title = Yii::t('app', 'Create Contact Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contact Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="contact-types-create card-box card">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
