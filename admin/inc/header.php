<?php
    include("inc/function.php")
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <?php if (!isset($_GET['cat'])) { ?>
                    <h1 class="m-0">Dashboard</h1>
                <?php } ?>

                <?php
                if (isset($_GET['cat'])) {
                    include("cat.php");
                }
                ?>
                

            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

