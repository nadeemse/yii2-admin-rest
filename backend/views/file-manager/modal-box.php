<?php
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Media Manager';

?>

<style type="text/css">
    .input-group .form-control {
        height: 38px;
    }
</style>


<div class="modal-dialog modal-lg">
    <div class="modal-content p-0 b-0">
        <div class="panel panel-color panel-success">
            <div class="panel-heading">
                <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="panel-title">Media Manager</h3>
            </div>

            <div class="panel-body" style="padding: 10px">

                <div class="row">
                    <div class="col-sm-5">

                        <?= Html::a('<i class="fa fa-level-up"></i>',
                            ['/file-manager', 'parent_id' => $data['parent'], 'target' => $data['target'], 'thumb' =>  $data['thumb']],
                            ['id' => 'button-parent', 'data-toggle' => 'tooltip', 'title' => 'Parent', 'class' => 'btn btn-default']);
                        ?>

                        <a href="<?= Yii::$app->request->url ?>" data-toggle="tooltip" title="Refresh" id="button-refresh" class="btn btn-default">
                            <i class="fa fa-refresh"></i>
                        </a>


                        <button type="button" data-toggle="tooltip" title="Upload" id="button-upload" class="btn btn-primary">
                            <i class="fa fa-upload"></i>
                        </button>

                        <button type="button" data-toggle="tooltip" title="New Folder" id="button-folder" class="btn btn-default">
                            <i class="fa fa-folder"></i>
                        </button>

                        <button type="button" data-toggle="tooltip" title="Delete" id="button-delete" class="btn btn-danger">
                            <i class="fa fa-trash-o"></i>
                        </button>

                    </div>

                    <div class="col-sm-7">
                        <div class="input-group">

                            <input type="text" name="search" value="<?= $searchModel->name; ?>" placeholder="Search.." class="form-control">

                        <span class="input-group-btn">
                            <button type="button" data-toggle="tooltip" title="Search" id="button-search" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>

                        </div>
                    </div>

                </div>


                <div class="" style="min-height: 400px; max-height: 400px; overflow-y: scroll;">
                    <hr />

                    <?php foreach (array_chunk($dataProvider->getModels(), 4) as $resources) { ?>
                        <div class="row">
                            <?php foreach ($resources as $resource) { ?>

                                <div class="col-sm-3 text-center media-manager">

                                    <?php if ($resource->type == 'folder') { ?>

                                        <div class="text-center">

                                            <?= Html::a('<i class="fa fa-folder fa-5x"></i>',
                                                ['/file-manager', 'parent_id' => $resource->id, 'target' => $data['target'], 'thumb' =>  $data['thumb']],
                                                [ 'class' => 'directory', 'style' => 'vertical-align: middle']);
                                            ?>
                                        </div>

                                        <label>
                                            <input type="checkbox" name="path[]" value="<?= $resource->id; ?>" />
                                            <?= $resource->name; ?>
                                        </label>

                                    <?php } ?>

                                    <?php if ($resource->type == 'file') { ?>

                                        <a href="<?= $resource->href; ?>" class="thumbnail">
                                            <img class="media-image" src="<?= $resource->href; ?>" alt="<?= $resource->name; ?>" title="<?= $resource->name; ?>" />
                                        </a>

                                        <label>
                                            <input type="checkbox" name="path[]" value="<?= $resource->id; ?>" />
                                            <?php echo substr($resource->name, 0, 20). '...'; ?>
                                        </label>

                                    <?php } ?>

                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>

            </div>

            <div class="panel-footer" style="padding: 0px 15px">
                <?= \yii\widgets\LinkPager::widget([
                    'pagination' => $dataProvider->pagination,
                ]); ?>
            </div>


        </div>
    </div><!-- /.modal-content -->
</div>

<script type="text/javascript">

    <!--
    <?php if ( $data['target'] ) { ?>
    $('a.thumbnail').on('click', function(e) {
        e.preventDefault();
        <?php if ( $data['thumb'] ) { ?>
        $('#<?php echo $data['thumb']; ?>').find('img').attr('src', $(this).find('img').attr('src'));
        <?php } ?>

        $('#<?php echo $data['target']; ?>').attr('value', $(this).find('img').attr('src'));

        $('#modal-image').modal('hide');
    });
    <?php } ?>

    $('a.directory').on('click', function(e) {
        e.preventDefault();
        $('#modal-image').load($(this).attr('href'));
    });

    $('.pagination a').on('click', function(e) {
        e.preventDefault();
        $('#modal-image').load($(this).attr('href'));
    });

    $('#button-parent').on('click', function(e) {
        e.preventDefault();

        $('#modal-image').load($(this).attr('href'));
    });

    $('#button-refresh').on('click', function(e) {
        e.preventDefault();

        $('#modal-image').load($(this).attr('href'));
    });

    $('input[name=\'search\']').on('keydown', function(e) {
        if (e.which == 13) {
            $('#button-search').trigger('click');
        }
    });

    $('#button-search').on('click', function(e) {

        var url = '<?= \yii\helpers\Url::to(['/file-manager', 'parent_id' => ($searchModel->parent_id ? $searchModel->parent_id : 0)  ]) ?>';

        var filter_name = $('input[name=\'search\']').val();

        if (filter_name) {
            url += '&name=' + encodeURIComponent(filter_name);
        }

        <?php if (isset( $data['thumb']) && !empty( $data['thumb'])) { ?>
            url += '&thumb=' + '<?php echo  $data['thumb']; ?>';
        <?php } ?>

        <?php if (isset( $data['target'] ) && !empty($data['target'])) { ?>
            url += '&target=' + '<?php echo $data['target']; ?>';
        <?php } ?>

        $('#modal-image').load(url);
    });

    $('#button-upload').on('click', function() {

        $('#form-upload').remove();

        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /></form>');

        $('#form-upload input[name=\'file\']').trigger('click');

        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }

        timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);

                $.ajax({
                    url: '<?= \yii\helpers\Url::to(['/file-manager/upload', 'parent_id' => $searchModel->parent_id]) ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,

                    beforeSend: function() {
                        $('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                        $('#button-upload').prop('disabled', true);
                    },

                    complete: function() {
                        $('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
                        $('#button-upload').prop('disabled', false);
                    },

                    success: function(json) {

                        if (json['error']) {
                            alert(json['error']);
                        }

                        if (json['success']) {
                            alert(json['success']);
                            $('#button-refresh').trigger('click');
                        }
                    },

                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }

                });
            }
        }, 500);
    });

    $('#button-folder').popover({
        html: true,
        placement: 'bottom',
        trigger: 'click',
        title: 'Folder Name',
        content: function() {
            html  = '<div class="input-group">';
            html += '  <input type="text" name="folder" value="" placeholder="Folder Name" class="form-control">';
            html += '  <span class="input-group-btn"><button type="button" title="New Folder" id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
            html += '</div>';

            return html;
        }
    });

    $('#button-folder').on('shown.bs.popover', function() {
        $('#button-create').on('click', function() {
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['/file-manager/folder', 'parent_id' => $searchModel->parent_id]) ?>',
                type: 'post',
                dataType: 'json',
                data: 'folder=' + encodeURIComponent($('input[name=\'folder\']').val()),
                beforeSend: function() {
                    $('#button-create').prop('disabled', true);
                },
                complete: function() {
                    $('#button-create').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        swal({
                            title: 'Opps!',
                            type: 'error',
                            text: json['error']
                        });
                    }

                    if (json['success']) {

                        swal({
                            title: 'Done!',
                            type: 'success',
                            text: json['success']
                        });


                        $('#button-refresh').trigger('click');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });
    });

    $('#button-delete').on('click', function(e) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: '<?= \yii\helpers\Url::to(['file-manager/delete']) ?>',
                type: 'post',
                dataType: 'json',
                data: $('input[name^=\'path\']:checked'),
                beforeSend: function() {
                    $('#button-delete').prop('disabled', true);
                },
                complete: function() {
                    $('#button-delete').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }

                    if (json['success']) {
                        alert(json['success']);

                        $('#button-refresh').trigger('click');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });

    //-->
</script>
