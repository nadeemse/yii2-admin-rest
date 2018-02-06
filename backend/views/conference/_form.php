<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Banners;

/* @var $this yii\web\View */
/* @var $model common\models\Conferences */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="conferences-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'dp_style')->dropDownList(['gallery-item wide' => 'Wide', 'gallery-item' => 'Normal'], ['maxlength' => true]) ?>
        </div>
    </div>


    <?= $form->field($model, 'short_description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'id' => 'elm1']) ?>

    <div class="row">
        <div class="col-sm-12">
            <div id="images" class="form-group">
                <label class="control-label" for="input-image">Pic</label>
                <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
                    <img src="<?php echo $model->icon; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
                </a>
                <?= $form->field($model, 'icon')->hiddenInput(['maxlength' => true, 'id' => 'input-image'])->label(false) ?>

            </div>
        </div>
    </div>



    <?= $form->field($model, 'banner_id')->dropDownList( ArrayHelper::map( Banners::find()->all(), 'id', 'name'), ['prompt' => 'Select Banner']) ?>

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
