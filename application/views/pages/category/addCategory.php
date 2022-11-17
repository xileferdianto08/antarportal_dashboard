<!DOCTYPE html>
<html>

<head>
    <?php
    echo $js;
    echo $css;
    ?>
    <style>
    </style>
    <title>AntarPortal | <?= $title; ?></title>
</head>

<body>
    <div class="modal" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"><b>Add new category</b></h4>
                </div>
                <div class="modal-body">
                    <?= form_open("Category/addCategory", array('class' => 'form-horizontal',)); ?>
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <label class="control-label col-sm-2">Category Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="category" placeholder="New Category name">
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <?php echo form_error('category', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                        </div>
                    </div><br>
                    <button class="btn btn-success btn-block" type="submit">Submit</button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button></a>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(window).on('load', function() {
            $('#add').modal('show');
        });
    </script>
</body>

</html>