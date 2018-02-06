<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
AppAsset::register($this);
?>
<?php
$baseURL = Yii::$app->getUrlManager()->getBaseUrl() . '/angular/';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">

    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon.ico">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="<?= $baseURL; ?>angular-timeago.js"></script>
    <script src="<?= $baseURL; ?>app.js"></script>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrapper" ng-app="afroApp">

    <?php echo $this->render('left-bar', []); ?>

    <div class="main-panel">
        <?php echo $this->render('top-bar', []); ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 card">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?= Alert::widget() ?>
                    </div>
                </div>
                <?= $content ?>
            </div>
        </div>

        <?php echo $this->render('footer', []); ?>

    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){

        demo.initChartist();

        var alertPopup = function (icon, message) {
            $.notify({
                icon: icon,
                message: message

            },{
                type: 'success',
                timer: 4000
            });

        }

    });
</script>

<?php $this->endPage() ?>
