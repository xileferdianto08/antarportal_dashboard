<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AntarPortal | <?= $title; ?></title>
    <?= $css; ?>
    <?= $js; ?>

    <style>
        * {
            overflow-x: clip;
        }

        .editBtn {
            color: #ffc107;
            transition: 0.3s;
        }

        .editBtn:hover {
            color: grey;
        }

        .deleteBtn {
            color: #dc3545;
            transition: 0.3s;
        }

        .deleteBtn:hover {
            color: grey;
        }

        .bluetext {
            color: #3d66a7;
            text-decoration: none;
        }

        .addBtn {
            float: right;
            margin-bottom: 2%;
            margin-right: 15px;
            margin-top: -4%;
        }
    </style>


</head>

<body>
    <?= $navbar; ?>
    <br>
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center bluetext" id="addModal"><b>Add new category</b></h4>
                </div>
                <div class="modal-body">
                    <?= form_open("Category/addCategory", array('class' => 'form-horizontal',)); ?>
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <label class="control-label"><strong>Category Name:</strong></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="category" placeholder="Category name">
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <?php echo form_error('category', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                        </div>
                    </div><br>
                    <div style="margin-left: 30%;">
                        <button class="btn btn-primary btn-block me-2" type="submit">Submit</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button></a>
                    </div>


                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center bluetext" id="editModal"><b>Edit category</b></h4>
                </div>
                <div class="modal-body">
                    <?php foreach ($categoryName as $n) : ?>
                        <?= form_open("Category/editCategory/$id", array('class' => 'form-horizontal',)); ?>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <label class="control-label"><strong>Category Name:</strong></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="category" value="<?= $n['categoryName']; ?>" required>
                            </div>
                        </div><br>
                        <div style="margin-left: 30%;">
                            <button class="btn btn-primary btn-block me-2" type="submit">Edit</button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button></a>
                        </div>

                    <?php endforeach; ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-7">
                <h4 class="bluetext" style="padding-top:2%;margin-left:2%;margin-top:2%"><b>Category List</b></h4>

                <button class="btn btn-sm btn-primary addBtn" data-bs-toggle="modal" data-bs-target="#add"><i class="bi bi-plus-circle"></i> New Category</button>
                <br>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-tab-card">
                        <table class="table table-hover" cellspacing="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($category as $c) : ?>

                                    <tr>
                                        <td class="text-center"><?= $i ?></td>
                                        <td><?= $c['categoryName'] ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url("Category/showEditForm/"), $c['categoryId']; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this Category"><i class="bi bi-tools me-3 editBtn"></i></a>
                                            <a href="<?= base_url("Category/deleteCategory/"), $c['categoryId'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete this Category" onclick="return confirm('Are you sure want to delete this category?')"><i class="bi bi-x-circle-fill deleteBtn"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                    $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $modal; ?>


    <br>
    <br>
    <br>
    <br>
    <br>
    <?= $footer ?>
</body>