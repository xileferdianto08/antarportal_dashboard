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
                        <h3 class="text-center" style="color:#3d66a7; text-decoration:none"><b>Edit Post</b></h3><br>
                        <?php
                        foreach ($content as $p) :
                            echo form_open_multipart("Main/editPost/$id", array('class' => 'form-horizontal',)); ?>

                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="name" class="control-label" style="text-align:left; margin-top:2%"><b>Title:</b></label><br>
                                <div class="col-lg-12">
                                    <?= form_input('title', $p['postTitle'], 'class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="name" class="control-label" style="text-align:left; margin-top:2%"><b>Author:</b></label><br>
                                <div class="col-lg-12">
                                    <?= form_input('author', $p['postAuthor'], 'class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="date" class="control-label" style="text-align:left; margin-top:2%"><b>Publish Date:</b></label><br>
                                <div class="col-lg-12">
                                    <input type="date" class="form-control" id="date" name="date" style="width:100%" value="<?= $p['publishDate'] ?>">
                                </div>


                            </div>
                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="category" class="control-label" style="text-align:left; margin-top:2%"><b>Category:</b></label><br>
                                <div class="col-lg-12">
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected>Choose Post's Category</option>
                                        <?php foreach ($category as $c) : ?>
                                            <option value="<?= $c['categoryId']; ?>" <?php if ($p['categoryName'] === $c['categoryName']) echo "selected"; ?>><?= $c['categoryName'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="content" class="control-label" style="text-align:left; margin-top:2%"><b>Content:</b> </label><br>
                                <div class="col-lg-12">
                                    <textarea name="content" class="form-control" id="content" cols="90" rows="10"><?= $p['content'] ?></textarea>
                                </div><br>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-1"></div>
                                <label for="image" class="control-label" style="text-align:left"><b>Post Picture:</b></label><br>
                                <div class="col-lg-12">
                                    <input id="image" name="image" type="file" onchange="displayImage(this)" class="form-control" style="display: none;" />
                                    <img id="new_image" src="<?php echo base_url('assets/postAssets/'), $p['postPicture'] ?>" alt="No Photo Used/Available" width="100%" onclick="triggerClick()">


                                    <?php echo form_hidden('old_image', $p['postPicture']); ?>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div style="margin-left: 40%;margin-top:2%; margin-bottom:2%">
                                    <button type="submit" class="btn btn-primary" name="submit" onclick="return confirm('Are all the data filled correctly?')">Edit</button>
                                    <a href="<?= base_url('Main') ?>"><button type="button" class="btn btn-warning">Cancel</button></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?= form_close(); ?>
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