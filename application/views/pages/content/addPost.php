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
    </style>
</head>

<body>
    <?= $navbar; ?>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-3">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-tab-card">
                        <h3 class="text-center" style="color:#3d66a7; text-decoration:none"><b>Add New Post</b></h3><br>
                        <?= form_open_multipart("Main/addPost", array('class' => 'form-horizontal',)); ?>

                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="title" class="control-label" style="text-align:left; margin-top:2%"><b>Title:</b></label><br>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="col-lg-2"></div>
                            <div class="col-lg-12">
                                <?php echo form_error('title', '<p style="color:red;margin:0;padding:0;">*', '</p>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="author" class="control-label" style="text-align:left; margin-top:2%"><b>Author:</b></label><br>
                            <div class="col-lg-12">
                                <input type="text" class="form-control" name="author" id="author" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="date" class="control-label" style="text-align:left; margin-top:2%"><b>Publish Date:</b></label><br>
                            <div class="col-lg-12">
                                <input type="date" class="form-control" id="date" name="date" style="width:100%" max="<?= date("Y-m-d") ?>" required>
                            </div>


                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="category" class="control-label" style="text-align:left; margin-top:2%"><b>Category:</b></label><br>
                            <div class="col-lg-12">
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">Choose Post's Category</option>
                                    <?php foreach ($category as $c) : ?>
                                        <option value="<?= $c['categoryId']; ?>"><?= $c['categoryName'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="content" class="control-label" style="text-align:left; margin-top:2%"><b>Content:</b> </label><br>
                            <div class="col-lg-12">
                                <textarea name="content" class="form-control" id="content" cols="90" rows="10" required></textarea>
                            </div><br>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-1"></div>
                            <label for="image" class="control-label" style="text-align:left"><b>Post Picture:</b></label><br>
                            <div class="col-lg-12">
                                <input id="image" name="image" type="file" class="form-control" onchange="displayImage(this)" style="display: none;" />
                                <img id="new_image" src="<?php echo base_url('assets/postAssets/default.png') ?>" alt="No Photo Used/Available" width="100%" onclick="triggerClick()">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div style="margin-left: 40%;margin-top:2%; margin-bottom:2%">
                                <button type="submit" class="btn btn-primary" name="submit">Add</button>
                                <a href="<?= base_url('Main') ?>"><button type="button" class="btn btn-warning">Cancel</button></a>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('content');
    </script>
    <script>
        function triggerClick(e) {
            document.querySelector('#image').click();
        }

        function displayImage(e) {
            if (e.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#new_image').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(e.files[0]);
            }
        }
    </script>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?= $footer ?>
</body>