<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AntarPortal | <?= $title; ?></title>
    <?= $css; ?>
    <style>
        .userImg {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-bottom: 1%;
            margin-top: 1;
        }

        .postImg {
            width: 50%;
            height: 50%;
        }

        .fa {
            margin-left: 65%;
            cursor: pointer;
            user-select: none;
        }

        .fa:hover {
            color: grey;
        }
    </style>
</head>

<body>
    <?= $navbar; ?>
    <br>
    <?php foreach ($content as $p) : ?>
        <div class="container">
            <h2 class="mt-2"><strong><?= $p['postTitle']; ?></strong></h2>
            <p style="font-size: 14px;" class="text-muted"><strong>Author: </strong><?= $p['postAuthor']; ?> - <strong> Date: </strong><?= $p['publishDate']; ?></p>
            <p style="font-size: 14px; color: grey;"><strong>
                    Category:
                </strong><a href="<?= base_url("Main/postPerCategory/"), $p['categoryId'] ?>"><?= $p['categoryName']; ?></a></p> <br>
            <img src="<?= base_url("assets/postAssets/"), $p['postPicture'] ?>" alt="" class="postImg"><br><br>
            <p style="font-size: 16px; color:black"><?= $p['content'] ?></p>

            <br>
            <br>

            <h3 style="margin-top:3%; margin-bottom:1%"><b>Comments</b></h3>
            <?php
            if (count($comment) > 0) {
                foreach ($comment as $c) : ?>
                    <div class="card" style="width: 50%;margin-top:2%; margin-bottom:1%;">
                        <div class="card-body">
                            <?php if ($c['fotoUser'] == NULL) { ?>
                                <img src="<?= base_url("assets/profileUser/avatar.png") ?>" class="userImg">
                            <?php } else { ?>
                                <img src="<?= base_url("assets/profileUser/"), $c['fotoUser'] ?>" class="userImg">
                            <?php } ?>

                            <h5 class="class-title"><?= $c['firstName'] . " " . $c['lastName'] ?></h5>

                            <h6 class="card-subtitle mb-2 text-muted"><?= $c['commentDate'] ?></h6>
                            <p class="card-text"><?= $c['comment'] ?></p>
                        </div>
                    </div>
            <?php endforeach;
            } else { ?>
                <br><h3 class="text-center"><strong>No comments available</strong></h3>
           <?php } ?>



        </div>
    <?php endforeach; ?>

    <br>
    <br>
    <br>
    <br>

    <?= $footer ?>
</body>