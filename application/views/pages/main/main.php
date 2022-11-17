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
        .editBtn{
            color : #ffc107;
            transition: 0.3s;
        }
        .editBtn:hover{    
            color: grey;
        }

        .deleteBtn{
            color:#dc3545;
            transition: 0.3s;
        }

        .deleteBtn:hover{
            color: grey;
        }

    </style>


</head>

<body>
    <?= $navbar; ?>
    <header>
        <ul class="nav nav-pills mb-auto justify-content-center">
            <li class="nav-item mt-3 mb-4">
                <a href="<?= base_url("Main"); ?>" class="nav-link active" style="background-color: #17a2b8;"><i class="bi bi-house-fill"></i> Home</a>
            </li>
            <?php foreach ($category as $c) : ?>
                <li class="nav-item mt-3 mb-4">
                    <a href="<?= base_url("Main/postPerCategory/"), $c['categoryId']; ?>" class="nav-link hyperlink"><?= $c['categoryName']; ?></a>
                </li>
            <?php endforeach; ?>
            <li class="nav-item mt-3 mb-4">
                <a href="<?= base_url("Main/showAddForm") ?>" class="nav-link active"><i class="bi bi-plus-square"></i> Add Post</a>
            </li>
        </ul>
    </header>
    <div class="row-cols-sm-1">
        <main class="container">
            <?php foreach ($posts as $p) : ?>
                <section class="card" data-aos="fade-left">
                    <a href="<?= base_url("Main/details/"),$p['postId'] ?>" class="img"><img src="<?= base_url("assets/postAssets/"), $p['postPicture']; ?>" alt="" class="img"></a>
                    <div>
                        <h3> <a href="<?= base_url("Main/details/"),$p['postId'] ?>" class="hyperlink"><?= $p['postTitle']; ?></a></h3>
                        <p>By: <?= $p['postAuthor']; ?> </p>
                        <p>Date: <?= $p['publishDate']; ?></p>
                        <p>Category: <a href="<?= base_url("Main/postPerCategory/"), $p['categoryId']; ?>" class="hyperlink"><?= $p['categoryName']; ?></a></p>
                        <div class="text-end">
                            <a href="<?= base_url("Main/showEditForm/"),$p['postId'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit this Post"><i class="bi bi-toggles me-3 editBtn" style="font-size:25px;"></i></a>
                            <a href="<?= base_url("Main/deletePost/"),$p['postId'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete this Post"><i class="bi bi-trash deleteBtn" style="font-size:25px;" onclick="return confirm('Are you sure want to delete this post?')"></i><script></script></a>
                        </div>

                    </div>

                </section>
            <?php endforeach; ?>
        </main>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?= $footer; ?>

    <script>
        AOS.init();
    </script>
</body>

</html>