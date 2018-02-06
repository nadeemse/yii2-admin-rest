<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Testimonial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testimonial-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'customer')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div id="images" class="form-group">
                <label class="control-label" for="input-image">Review Image</label>
                <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
                    <img src="<?php echo $model->logo; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
                </a>
                <?= $form->field($model, 'logo')->hiddenInput(['maxlength' => true, 'id' => 'input-image'])->label(false) ?>

            </div>
        </div>
    </div>

    <?= $form->field($model, 'review')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'rating')->dropDownList(range(1, 5), ['prompt' => 'Select Rating']) ?>
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
