<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\States */

$this->title = Yii::t('app', 'Create States');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'States'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

</div>
