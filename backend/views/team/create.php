<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Team */

$this->title = 'Create Team';
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">

    <div class="menu-create card card-box">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>

</div>