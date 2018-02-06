<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Languages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="languages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <div id="images" class="form-group">
        <label class="control-label" for="input-image">Flag</label>
        <a href="" id="thumb-banner_image" data-toggle="image" class="img-thumbnail">
            <img src="<?= $model->flag; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
        </a>

        <?= $form->field($model, 'flag')->hiddenInput([ 'id' => 'input-banner_image' ])->label(false) ?>

    </div>


    <?= $form->field($model, 'status')->dropDownList(['In-Active', 'Active'], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
