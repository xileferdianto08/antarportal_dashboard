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
        *{
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
        .searchBar{
            float:right;
            margin-bottom:2%;
            margin-right:15px;
            margin-top:-4%;
            border-radius: 5px;
        }
    </style>


</head>

<body>
    <?= $navbar; ?>
    <br>
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h4 class="bluetext" style="padding-top:2%;margin-left:2%;margin-top:2%"><b>Post's Comment List</b></h4>
                <input type="text" id="search" class="searchBar" placeholder="Type to search">
                <table class="table table-hover" cellspacing="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">User</th>
                            <th class="text-center">Commented</th>
                            <th class="text-center">At</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="comment">
                        <?php
                        $i = 1;
                        if (count($comment) > 0) {
                            foreach ($comment as $c) : ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td class="text-center"><?= $c['firstName'] . " " . $c['lastName']; ?></td>
                                    <td class="text-center"><?= $c['comment'] ?></td>
                                    <td><a href="<?= base_url("Main/details/"),$c['postId'] ?>" class="hyperlink"><?= $c['postTitle'] ?></td>
                                    <td><?= $c['commentDate'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url("Comment/deleteComment/"),$c['commentId'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete this Comment" onclick="return confirm('Are you sure want to delete this comment?')"><i class="bi bi-x-circle-fill deleteBtn"></i></a>
                                    </td>

                                </tr>
                            <?php
                                $i++;
                            endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center">
                                    <h3>No comments available</h3>
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?= $footer ?>

    <script>
        var $rows = $('#comment tr');
        $('#search').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
</body>