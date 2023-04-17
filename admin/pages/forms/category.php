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
                
                <div class="card card-body">
                    <?php if (isset($_GET['edit_cat'])) {
                            echo edit_cat();
                    } //else {
                        ?>
                    <p>
                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Add Category
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <form method="POST" action="../code/add-category.php" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" name="cat_name" class="form-control" id="categoryName" placeholder="Enter Category Name" required>
                                </div>
                                <button name="add_cat" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <table id="example2" class="table table-bordered table-hover col-md-12">
                <thead>
                    <tr>
                        <th>SR Number</th>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php echo show_cat(); ?>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
                   
        include "../includes/footer.php";
                   
?>