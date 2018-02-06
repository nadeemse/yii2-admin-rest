<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;


/* @var $this yii\web\View */
/* @var $model common\models\Categories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-12 card card-box">

        <p class="pull-right">
            <?= Html::a('Add New', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>


        <div class="row">
            <div class="col-lg-12">

                <ul class="nav nav-tabs tabs">

                    <li class="active tab">
                        <a href="#basic" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-home"></i></span>
                            <span class="hidden-xs">Basic</span>
                        </a>
                    </li>

                    <li class="tab">
                        <a href="#description" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Description</span>
                        </a>
                    </li>


                    <li class="tab">
                        <a href="#filters" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Filters</span>
                        </a>
                    </li>

                </ul>


                <div class="tab-content">

                    <div class="tab-pane active" id="basic">


                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'name',
                                'slug',
                                'href',
                                'banner',
                                [
                                    'attribute' => 'parent_id',
                                    'value' => ( !empty($model->parent) ? $model->parent->name : 'N/A')
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => $model->status == 1 ? 'Active' : 'In-Active'
                                ],
                            ],
                        ]) ?>


                    </div>

                    <div class="tab-pane" id="description">


                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'description:raw',
                                'meta_description',
                                'meta_keywords'
                            ],
                        ]) ?>


                    </div>


                    <div class="tab-pane" id="filters">


                        <?php Pjax::begin(); ?>

                        <?= GridView::widget([
                            'dataProvider' => new ActiveDataProvider([
                                'query' => $model->getFilters(),
                                'pagination' => [
                                    'pageSize' => 10,
                                ]]),
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'filter_id',
                                    'value' => function($model) {
                                        return $model->filter->name;

                                    }
                                ],
                                [
                                    'attribute' => 'is_required',
                                    'value' => function($model) {
                                        return $model->is_required == 0 ? 'NO' : 'YES';
                                    }
                                ],
                                'type'
                            ],
                        ]); ?>

                        <?php Pjax::end(); ?>


                    </div>

                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
</div>
