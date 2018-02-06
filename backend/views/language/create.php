<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Languages */

$this->title = Yii::t('app', 'Create Languages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="languages-create card card-box">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>

