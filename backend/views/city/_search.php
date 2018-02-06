<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Country;

/* @var $this yii\web\View */
/* @var $model app\models\CitiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-3 col-sm-12">
            <?= $form->field($model, 'name') ?>
        </div>
        <div class="col-lg-3 col-sm-12">
            <?= $form->field($model, 'country_id')->dropDownList( ArrayHelper::map(Country::find()->all(), 'id', 'country_name'), ['prompt' => 'Select Country']) ?>
        </div>
        <div class="col-lg-3 col-sm-12">
            <?= $form->field($model, 'city_code') ?>
        </div>

        <div class="col-lg-3 col-sm-12">
            <?= $form->field($model, 'status')->dropDownList(['In-active', 'Active'], ['prompt' => 'Select Status']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group pull-right">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
