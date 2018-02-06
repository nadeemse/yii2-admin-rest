<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ContactTypes;

/* @var $this yii\web\View */
/* @var $model app\models\ContactUsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-us-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   <div class="row">
       <div class="col-sm-12 col-lg-3">
           <?= $form->field($model, 'first_name') ?>
       </div>

       <div class="col-sm-12 col-lg-3">
           <?= $form->field($model, 'last_name') ?>
       </div>


       <div class="col-sm-12 col-lg-3">
           <?= $form->field($model, 'phone_number') ?>
       </div>

       <div class="col-sm-12 col-lg-3">
           <?= $form->field($model, 'email') ?>
       </div>
   </div>

    <div class="row">

        <div class="col-sm-12 col-lg-5">
            <?php echo $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(ContactTypes::find()->all(), 'id', 'name'), ['prompt' => 'Select Type']) ?>
        </div>

        <div class="col-sm-12 col-lg-5">
            <?php echo $form->field($model, 'message') ?>
        </div>

        <div class="col-sm-12 col-lg-2">
            <div class="form-group inline-row">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
