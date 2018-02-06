<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$banner = \common\models\Banners::find()->where(['slug' => 'blog-banner'])->one();

if($banner !== null) {
    $bannerImages = $banner->bannerImages;
} else {
    $bannerImages = [];
}

/* @var $this yii\web\View */
/* @var $model common\models\Blogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blogs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'id' => 'elm1']) ?>

    <div id="images" class="form-group">
        <label class="control-label" for="input-image">Banner</label>
        <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
            <img src="<?= $model->banner; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
        </a>
        <input type="hidden" name="Blogs[banner]" value="<?php echo $model->banner; ?>" id="input-image" />

    </div>

    <?= $form->field($model, 'banner_id')->dropDownList(ArrayHelper::map($bannerImages, 'id', 'title'), ['prompt' => 'Select Banner']) ?>

    <?php echo $form->field($model, 'onHome')->dropDownList(['No', 'Yes'], ['prompt' => 'is On Home']) ?>

    <?php echo $form->field($model, 'status')->dropDownList(['In-Active', 'Active'], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
