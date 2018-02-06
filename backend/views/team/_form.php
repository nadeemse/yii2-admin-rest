<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Team */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="team-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'short_bio')->textarea(['rows' => 6, 'maxlength' => true]) ?>

    <?= $form->field($model, 'bio')->textarea(['rows' => 6, 'maxlength' => true, 'id' => 'elm1']) ?>

    <div class="row">

        <div class="col-sm-3">
            <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'youtube')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div id="images" class="form-group">
                <label class="control-label" for="input-image">Pic</label>
                <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
                    <img src="<?php echo $model->pic; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
                </a>
                <?= $form->field($model, 'pic')->hiddenInput(['maxlength' => true, 'id' => 'input-image'])->label(false) ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'In-Active'], ['prompt' => 'Select Status']) ?>
        </div>
    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
