<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Banners;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textarea(['maxlength' => true]) ?>


    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'id' => 'elm1']) ?>

    <div id="images" class="form-group">
        <label class="control-label" for="input-image">Banner</label>
        <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
            <img src="<?= $model->banner; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
        </a>
        <input type="hidden" name="News[banner]" value="<?php echo $model->banner; ?>" id="input-image" />

    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <?= $form->field($model, 'tag')->textInput() ?>
        </div>
        <div class="col-lg-6 col-sm-12">

            <?= $form->field($model, 'banner_id')->dropDownList(ArrayHelper::map(Banners::find()->all(), 'id', 'name'), ['prompt' => 'Select Banner']) ?>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <?= $form->field($model, 'status')->dropDownList(['In-Active', 'Active'], ['prompt' => 'Select Status']) ?>
        </div>

        <div class="col-lg-6 col-sm-12">
            <?= $form->field($model, 'column')->dropDownList(['col-md-4' => '3 in row', 'col-md-6' => '2 in row', 'col-md-12' => 'one in row'], ['prompt' => 'Select style']) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
