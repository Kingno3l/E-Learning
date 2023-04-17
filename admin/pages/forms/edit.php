<?php
include "../includes/header.php";
include "../code/add-category.php"
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show col-md-12 mx-auto" role="alert">
                        <?php echo $_GET['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show col-md-12 mx-auto" role="alert">
                        <?php echo $_GET['success']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>

                <?php

                $id = $_GET['id'];

                $get_cat = $con->prepare("select * from cat where cat_id = '$id'");
                $get_cat->setFetchMode(PDO::FETCH_ASSOC);
                $get_cat->execute();
                $row = $get_cat->fetch();
                ?>

                <div class="card card-body">
                    <h3>Edit Category</h3>

                    <form method="post" action="../code/edit-category.php" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" name="cat_name" value="<?php echo $row['cat_name']; ?>" class="form-control" id="categoryName" placeholder="Enter Category Name">
                                <input type="hidden" name="cat_id" value="<?php echo $id; ?>">

                            </div>
                            <button name="edit_cat" class="btn btn-primary">Submit</button>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            </div>
            <!-- Table -->
        </div>
    </div>
</div>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php

include "../includes/footer.php";

?>