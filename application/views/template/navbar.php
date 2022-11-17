<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid justify-content-between">
        <a href="<?= base_url("Main"); ?>" class="navbar-brand" style="font-size:26px"><i class="bi bi-newspaper"></i> AntarPortal Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0"></ul>
            <ul class="navbar-nav navbar-right " style="padding:0 1% 0 0">
                <li class="nav-item">
                    <a href="<?= base_url("Main") ?>" class="nav-link" aria-current="page">Content</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url("Category") ?>" class="nav-link">Category</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url("Comment") ?>" class="nav-link">Comment</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url("About") ?>" class="nav-link">About</a>
                </li>

            </ul>
        </div>
    </div>

</nav>