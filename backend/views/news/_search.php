<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">

        <div class="col-lg-6 col-sm-12">
            <?= $form->field($model, 'title') ?>
        </div>

        <div class="col-lg-6 col-sm-12">
            <?= $form->field($model, 'short_description') ?>
        </div>

    </div>


    <div class="row">

        <div class="col-lg-4 col-sm-12">
            <?php echo $form->field($model, 'viewCount') ?>
        </div>

        <div class="col-lg-4 col-sm-12">
            <?php echo $form->field($model, 'likeCount') ?>
        </div>

        <div class="col-lg-4 col-sm-12">
            <?php echo $form->field($model, 'commentCount') ?>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-6 col-sm-12">
            <?php echo $form->field($model, 'status')->dropDownList(['In-Active', 'Active'], ['prompt' => 'Select Status']) ?>
        </div>

        <div class="col-lg-6 col-sm-12">
            <label>&nbsp;</label>
            <div class="form-group">

                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
            </div>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
