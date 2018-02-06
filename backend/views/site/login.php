<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/custom/css/core.css");
$this->registerCssFile("@web/custom/css/components.css");
$this->registerCssFile("@web/custom/css/pages.css");
$this->registerCssFile("@web/custom/css/responsive.css");

?>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"> Login to <strong class="text-custom">Yii Boilerplate</strong> </h3>
        </div>


        <div class="panel-body">

            <?php $form = ActiveForm::begin(['class' => 'form-horizontal m-t-20']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <div class="col-xs-12">
                    <div class="checkbox checkbox-primary">
                        <input id="checkbox-signup" type="checkbox" name="AdminLoginForm[rememberMe]">
                        <label for="checkbox-signup">
                            Remember me
                        </label>
                    </div>

                </div>
            </div>


            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-pink btn-block text-uppercase waves-effect waves-light', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
