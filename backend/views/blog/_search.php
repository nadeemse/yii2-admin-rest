<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BlogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blogs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-lg-4 col-sm-12">
            <?= $form->field($model, 'short_description') ?>
        </div>
        <div class="col-lg-4 col-sm-12">
            <?php echo $form->field($model, 'status')->dropDownList(['In-Active', 'Active'], ['prompt' => 'Select Status']) ?>
        </div>
    </div>




    <?php //$form->field($model, 'description') ?>

    <?php //$form->field($model, 'banner') ?>

    <?php // echo $form->field($model, 'banner_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>



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
