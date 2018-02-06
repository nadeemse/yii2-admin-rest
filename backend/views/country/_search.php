<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CountrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row">

        <div class="col-sm-4">
            <?= $form->field($model, 'country_code') ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'country_name') ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'isAvailable')->dropDownList(['No', 'Yes'], ['prompt' => 'Is Available for ads']) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary pull-right']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default pull-right']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
