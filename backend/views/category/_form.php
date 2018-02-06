<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Categories;
use yii\helpers\ArrayHelper;
use common\models\Filters;

/* @var $this yii\web\View */
/* @var $model common\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $filters = Filters::find()->all();
    $requires = ['NO', 'YES'];
    $types = ['primary' => 'Primary', 'advance' => 'Advance', 'notIncluded' => 'Do not Show'];
    $classes = ['col-sm-12' => 'Full Width', 'col-sm-6' => 'Half Width'];
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

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


                    <div class="row">
                        <div class="col-sm-6"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-sm-6"> <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <?= $form->field($model, 'parent_id')->dropDownList( ArrayHelper::map(Categories::find()->all(), 'id', 'name'), ['prompt' => 'Select Category']) ?>

                    <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'In-Active'], ['prompt' => 'Select Status']) ?>

                    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true]) ?>

                    <div id="images" class="form-group">
                        <label class="control-label" for="input-image">Banner Image</label>
                        <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">
                            <img src="<?php echo $model->banner; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
                        </a>
                        <input type="hidden" name="Categories[banner]" value="<?php echo $model->banner; ?>" id="input-image" />
                    </div>


                    <div class="row">

                        <div class="col-sm-6">
                            <div id="images" class="form-group">
                                <label class="control-label" for="input-image">Header Image</label>
                                <a href="" id="thumb-header" data-toggle="image" class="img-thumbnail">
                                    <img src="<?php echo $model->header; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
                                </a>
                                <?= $form->field($model, 'header')->hiddenInput(['maxlength' => true, 'id' => 'input-header'])->label(false) ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div id="images" class="form-group">
                                <label class="control-label" for="input-image">Mobile Header</label>
                                <a href="" id="thumb-mobileHeader" data-toggle="image" class="img-thumbnail">
                                    <img src="<?php echo $model->mobile_header; ?>" alt="" width="125" height="125" title="" data-placeholder="no_image.png" />
                                </a>
                                <?= $form->field($model, 'mobile_header')->hiddenInput(['maxlength' => true, 'id' => 'input-mobileHeader'])->label(false) ?>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="tab-pane" id="description">

                    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'id' => "elm1"]) ?>

                    <?= $form->field($model, 'meta_description')->textarea(['maxlength' => true]) ?>

                    <?= $form->field($model, 'meta_keywords')->textarea(['maxlength' => true]) ?>



                </div>


                <div class="tab-pane" id="filters">


                    <table id="images" class="table table-striped table-bordered table-hover images-table upload-preview">
                        <thead>
                        <tr>
                            <td class="text-left">Filter</td>
                            <td class="text-left">Is Required</td>
                            <td class="text-left">Display Type</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $image_row = 0; ?>
                        <?php foreach ($model->filters as $catFilter) { ?>
                            <tr id="image-row<?php echo $image_row; ?>">
                                <input type="hidden" name=Categories[categoryFilters][<?php echo $image_row; ?>][id]" value="<?= $catFilter->id ?>" placeholder="Title" class="form-control" />
                                <td class="">
                                    <div class="form-group">
                                        <select name="Categories[categoryFilters][<?php echo $image_row; ?>][filter_id]" class="form-control">
                                            <option>Select Filter</option>

                                            <?php foreach($filters as $filter) { ?>
                                                <?php if($filter->id === $catFilter->filter_id) { ?>
                                                    <option value="<?= $filter->id ?>" selected><?= $filter->name ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $filter->id ?>"><?= $filter->name ?></option>
                                                <?php } ?>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </td>

                                <td class="">
                                    <div class="form-group">

                                        <select name="Categories[categoryFilters][<?php echo $image_row; ?>][is_required]" class="form-control">
                                            <option>is Required</option>
                                            <?php foreach($requires as $key => $require) { ?>
                                                <?php if($key === $catFilter->is_required) { ?>
                                                    <option value="<?= $key ?>" selected><?= $require ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $key ?>"><?= $require ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </td>

                                <td class="">
                                    <div class="form-group">

                                        <select name="Categories[categoryFilters][<?php echo $image_row; ?>][type]" class="form-control">
                                            <option>Select Type</option>
                                            <?php foreach($types as $key => $type) { ?>
                                                <?php if($key === $catFilter->type) { ?>
                                                    <option value="<?= $key ?>" selected><?= $type ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $key ?>"><?= $type ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </td>

                                <td class="">
                                    <div class="form-group">

                                        <select name="Categories[categoryFilters][<?php echo $image_row; ?>][class]" class="form-control">
                                            <option>Select Display</option>
                                            <?php foreach($classes as $key => $type) { ?>
                                                <?php if($key === $catFilter->type) { ?>
                                                    <option value="<?= $key ?>" selected><?= $type ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $key ?>"><?= $type ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </td>

                                <td class="text-left">
                                    <button type="button" onclick="$('#image-row<?php echo $image_row; ?>, .tooltip').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                </td>
                            </tr>
                            <?php $image_row++; ?>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Add" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                        </tfoot>
                    </table>



                </div>

            </div>
        </div>
    </div>
    <!-- end row -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript">
    var image_row = <?= $image_row ?>;

    function addImage() {
        html  = '<tr id="image-row'+ image_row +'">';


        html += '<td>';
        html += '    <div class="form-group">';

        html += '<select name="Categories[categoryFilters]['+image_row+'][filter_id]" class="form-control">';
        html += '    <option>Select Filter</option>';
        <?php foreach($filters as $filter) { ?>
            html += '<option value="<?= $filter->id ?>"><?= $filter->name ?></option>';
        <?php } ?>
        html += '</select>';

        html += '    </div>';
        html += '  </td>';

        html += '  <td class="">';
        html += '    <div class="form-group">';
        html += '<select name="Categories[categoryFilters]['+image_row+'][is_required]" class="form-control">';
        html += '    <option>is Required</option>';
        <?php foreach($requires as $key => $require) { ?>
        html += '<option value="<?= $key ?>"><?= $require ?></option>';
        <?php } ?>
        html += '</select>';
        html += '    </div>';
        html += '  </td>';


        html += '  <td class="">';
        html += '    <div class="form-group">';
        html += '<select name="Categories[categoryFilters]['+image_row+'][type]" class="form-control">';
        html += '    <option>Select Type</option>';
        <?php foreach($types as $key => $type) { ?>
        html += '<option value="<?= $key ?>"><?= $type ?></option>';
        <?php } ?>
        html += '</select>';
        html += '    </div>';
        html += '  </td>';


        html += '  <td class=""><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

        html += '</tr>';

        $('#images tbody').append(html);

        image_row++;
    }
</script>
