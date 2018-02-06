<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model backend\models\StatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="states-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'country_id')->dropDownList( ArrayHelper::map(Country::find()->all(), 'id', 'country_name'), ['prompt' => 'Select Country']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="col-sm-4">
            <label>&nbsp;</label>
            <div class="form-group text-right">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
