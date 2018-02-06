<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Blogs */

$this->title = Yii::t('app', 'Create Blogs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="blogs-create card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>